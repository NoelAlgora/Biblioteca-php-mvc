<?php
class LibroController extends ControladorBase
{
    public function __construct() {
        parent::__construct();
    }

	public function index() //LIBROS DISPONIBLES
    {
        if(!$this->helper()->isUserLogged())
            return $this->redirect("user", "login");
        
        $libros = DaoLibro::getInstance()->getDisponibles();

        $this->view(
            "libro/index.php",
            [
                'libros' => $libros,
            ]
        );
    }

    public function todos()
    {
        if(!$this->helper()->isUserLogged())
            return $this->redirect("user", "login");

        $libros = DaoLibro::getInstance()->getAll();

        $this->view(
            "libro/todos.php",
            [
                'libros' => $libros,
            ]
        );
    }

    public function reservados() //LIBROS RESERVADOS
    {
        if(!$this->helper()->isAdmin())
            return $this->redirect("user", "login");

        $libros = DaoLibro::getInstance()->getReservados($this->helper()->getLoggedUser()['id']);

        $this->view(
            "libro/reservados.php",
            [
                'libros' => $libros,
            ]
        );
    }

    public function mis_prestamos() //MIS PRESTAMOS
    {
        if(!$this->helper()->isUserLogged())
            return $this->redirect("user", "login");

        $libros = DaoPrestamo::getInstance()->getMisPrestamos($this->helper()->getLoggedUser()['id']);

        $this->view(
            "libro/mis_prestamos.php",
            [
                'libros' => $libros,
            ]
        );
    }


    public function todos_prestamos()
    {
        if(!$this->helper()->isAdmin())
            return $this->redirect("user", "login");

        $libros = DaoPrestamo::getInstance()->getAll();

        $this->view(
            "libro/todos_prestamos.php",
            [
                'libros' => $libros,
            ]
        );
    }

    public function reservar()
    {
        $formErrors = [];

        if(!$this->helper()->isUserLogged())
            return $this->redirect("Site", "index");

        $user_id = $this->helper()->getLoggedUser()['id'];

        if (isset($_POST["libro_id"])) 
        {
            $libro_id = htmlspecialchars(trim(strip_tags($_POST["libro_id"])));

            if (!empty($libro_id)) {
                $id = DaoPrestamo::getInstance()->insertPrestamo($libro_id, $user_id);
            } 
        }

        $this->goBack();
    }

    public function devolver()
    {
        if(!$this->helper()->isUserLogged())
            return $this->redirect("Site", "index");

        $user_id = $this->helper()->getLoggedUser()['id'];

        if (isset($_POST["prestamo_id"])) 
        {
            $prestamo_id = htmlspecialchars(trim(strip_tags($_POST["prestamo_id"])));

            if (!empty($prestamo_id)) {
                $id = DaoPrestamo::getInstance()->devolverPrestamo($prestamo_id);
            } 
        }

        $this->goBack();
    }

    public function crear()
    {
        if(!$this->helper()->isAdmin())
            return $this->redirect("user", "login");

        $formErrors = [];

        $name = "";
        $author = "";
        $year = "";
        $genre = "";
        $resume = "";
        $descripcion =  "";

        if (isset($_POST["name"]) && isset($_POST["author"]) && 
            isset($_POST["year"]) && isset($_POST["resume"]) && isset($_POST["genre"])) 
        {
            $name = htmlspecialchars(trim(strip_tags($_POST["name"])));
            $author = htmlspecialchars(trim(strip_tags($_POST["author"])));
            $year = htmlspecialchars(trim(strip_tags($_POST["year"])));
            $genre = htmlspecialchars(trim(strip_tags($_POST["genre"])));
            $resume = htmlspecialchars(trim(strip_tags($_POST["resume"])));

            if (!empty($name) && !empty($author) && !empty($year) && !empty($genre) && !empty($resume) ) {
                $id = DaoLibro::getInstance()->insertLibro($name, $author, $genre, $year, $resume);

                if($id){
                    $this->redirect("Site", "index");
                }
                else {
                    $formErrors[] = "Error en la bd!";
                }

            } else { 
                $formErrors[] = "Errores formulario !";
            }

        }

        $this->view(
            "libro/crear.php",
            [
                'formErrors' => $formErrors,
                'name' => $name,
                'author' => $author,
                'year' => $year,
                'genre' => $genre,
                'resume' => $resume,
            ]
        );
    }
}
?>
