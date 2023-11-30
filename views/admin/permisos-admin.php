<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION["user"])) {
    echo "No autorizado, debes iniciar sesión primero.";
    echo "</br>";
    echo "<a href='/login'>Regresar a Login</a>";
    die();
} else if ($_SESSION["user"]["id_rol"] != 1) {
    echo "No autorizado, no tienes permiso para acceder a esta página.";
    echo "</br>";
    echo "<a href='/login'>Regresar</a>";
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="/assets/logo.jpg" />
    <link rel="stylesheet" href="/styles/index.css" />
    <script src="/scripts/header.js" defer></script>
    <script src="/scripts/admin/permisosAdmin.js" defer></script>
    <!--Tailwind
            Cambiar
            a
            CLI
            -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts and Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>UNIVERSITY - Alumnos</title>
</head>

<body>
    <div id="total-container" class="w-screen h-screen">
        <div id="left-menu" class="bg-[#343b40] w-[100%] h-[100%]">
            <div class="flex items-center p-[1rem]">
                <img alt="logo" src="/assets/logo.jpg" class="w-[24px] h-[24px] rounded-full" />
                <h1 class="text-[#fff] ml-[0.5rem] text-[20px]">Universidad</h1>
            </div>
            <hr />
            <div class="p-[1rem]">
                <h2 class="text-[#fff]">admin</h2>
                <h2 class="text-[#fff]">
                    <?php $admin = $_SESSION["user"]["nombre"];
                    echo "$admin"; ?>
                </h2>
            </div>
            <hr />
            <div class="p-[1rem]">
                <h2 class="text-center text-[#fff]">MENU ADMINISTRACIÓN</h2>
                <a href="/permisos/admin">
                    <h3 class="text-[#fff] flex cursor-pointer my-[1rem]">
                        <span class="material-symbols-outlined mr-[1rem]">
                            manage_accounts </span>Permisos
                    </h3>
                </a>
                <a href="/maestros/admin">
                    <h3 class="text-[#fff] flex cursor-pointer my-[1rem]">
                        <span class="material-symbols-outlined mr-[1rem]">
                            <span class="material-symbols-outlined"> co_present </span> </span>Maestros
                    </h3>
                </a>
                <a class="py-[1rem]" href="/alumnos/admin">
                    <h3 class="text-[#fff] flex cursor-pointer my-[1rem]">
                        <span class="material-symbols-outlined mr-[1rem]"> school </span>Alumnos
                    </h3>
                </a>
                <a class="my-[1rem]" href="/clases/admin">
                    <h3 class="text-[#fff] flex cursor-pointer my-[1rem]">
                        <span class="material-symbols-outlined mr-[1rem]">
                            <span class="material-symbols-outlined"> assignment </span> </span>Clases
                    </h3>
                </a>
            </div>
        </div>
        <div id="content" class="bg-[#f4f6fb] w-[100%] h-[100%]">
            <header class="w-[100%] h-[4rem] bg-[#fff] flex justify-between items-center px-[1rem] shadow-sm">
                <div id="menu-principal" class="flex cursor-pointer">
                    <span class="material-symbols-outlined"> menu </span>
                    <h2 class="ml-[1rem]">Home</h2>
                </div>
                <div class="flex cursor-pointer" id=show-modal>
                    <h2 class="ml-[1rem]">
                        <?php echo "$admin"; ?>
                    </h2>
                    <span id="more" class="material-symbols-outlined">expand_more</span>
                </div>
            </header>
            <div id="modal-user"
                class="bg-[#343b40] bg-opacity-90 absolute right-4 rounded-xl border border-[#E5e5e5] p-[0.5rem]">
                <div class="hover:bg-[#2e2e2e] cursor-pointer rounded-xl p-[0.5rem] my-[1rem] flex items-center">
                    <span class="material-symbols-outlined mr-[0.3rem] text-[#fff]"> person </span>
                    <span class="text-modal text-[#fff]">My Profile</span>
                </div>
                <hr class="border-[#fff]">
                <div id="logout" class="hover:bg-[#be6570] cursor-pointer rounded-xl p-[0.5rem] flex items-center">
                    <span class="material-symbols-outlined mr-[0.3rem] text-[#fff]"> logout </span>
                    <span class="text-modal text-[#fff]">Logout</span>
                </div>
            </div>
            <div class="p-[1rem]">
                <h1 class="text-[22px] py-[1rem] font-semibold">Lista de Permisos</h1>
                <div class="bg-[#fff] shadow-lg p-[1rem]">
                    <div class="flex justify-between items-center mb-[0.5rem]">
                        <h3>Información de Permisos</h3>
                    </div>
                    <hr />
                    <div>
                        <div class="flex justify-center items-center my-[0.5rem]">
                            <label for="search" class="mr-[1rem]">Search:</label>
                            <input class="h-[2.3rem] border border-slate-300 rounded-md px-[1rem] text-[#797675]"
                                id="search" name="search" />
                        </div>
                        <table class="w-[100%] table-auto">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">#</th>
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">
                                        Email / usuario
                                    </th>
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">Permiso</th>
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">Estado</th>
                                    <th class="bg-[#fff] text-[#000632] h-[3rem] w-[7%]">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data["permisos"] as $usuario) {
                                    ?>
                                <tr class="usuario" ?>
                                    <td class="h-[3rem] bg-[#f2f2f2]">
                                        <?= $usuario["id"] ?>
                                    </td>
                                    <td class="h-[3rem] bg-[#f2f2f2]">
                                        <?= $usuario["email"] ?>
                                    </td>
                                    <td class="h-[3rem] bg-[#f2f2f2]">
                                        <?php
                                            $rol = $usuario["id_rol"];
                                            if ($rol == "1") {
                                                echo "<span class='text-[12px] bg-[#cba51a] p-[0.2rem] rounded-md'>Administrador</span>";
                                            } elseif ($rol == "2") {
                                                echo "<span class='text-[12px] bg-[#1ca0b4] p-[0.2rem] rounded-md text-[#fff]'>Maestro</span>";
                                            } else {
                                                echo "<span class='text-[12px] bg-[#6f757e] p-[0.2rem] rounded-md text-[#fff]'>Alumno</span>";
                                            }
                                            ?>
                                    </td>
                                    <td class="h-[3rem] bg-[#f2f2f2]">
                                        <?php
                                            if ($usuario["estado"] == "1") {
                                                echo "<span class='text-[12px] bg-[#33a24f] p-[0.2rem] rounded-md text-[#fff]'>Activo</span>";
                                            } else {
                                                echo "<span class='text-[12px] bg-[#cc3e4d] p-[0.2rem] rounded-md text-[#fff]'>Inactivo</span>";
                                            }
                                            ?>
                                    </td>
                                    <td class="h-[3rem] bg-[#f2f2f2] flex justify-evenly items-center">
                                        <span data-id="<?= $usuario["id"] ?>"
                                            class="material-symbols-outlined cursor-pointer text-[#FFC300] edit-new">
                                            edit
                                        </span>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
        var clases = <?= json_encode($clases) ?>;
        </script>
    </div>
    <div id="edit" class="w-screen h-screen bg-[#000] bg-opacity-50 absolute top-0 grid place-content-center">
        <div class="w-[25rem] p-[1rem] bg-[#fff] shadow-xl opacity-100">
            <div class="flex justify-end">
                <span id="close-edit" class="material-symbols-outlined cursor-pointer"> close </span>
            </div>
            <h1 class="text-[28px] mb-[1rem]">Editar Permiso</h1>
            <hr />
            <div id="modal-edit" class=modal>
                <form id="form-edit" method="POST" action="" class="space-y-[0.5rem] my-[1rem]">
                    <input type="hidden" id="estado" name="estado">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" id="id" name="id" value="16">
                    <label for="email" class="text-[13px] font-semibold">Email</label>
                    <input type="email" name="email" id="email-edit" value=""
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]">
                    <label for="id_rol" class="text-[13px] font-semibold">Rol del usuario</label>
                    <select name="id_rol" id="rol-edit"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]">
                        <option selected="" hidden="">Selecciona el rol</option>
                        <option value="1">admin</option>
                        <option value="2">Maestro</option>
                        <option value="3">Alumno</option>
                    </select>
                    <div class="flex items-center mt-[10rem]" bis_skin_checked="1">
                        <div id="switch-button-container" class="switch" bis_skin_checked="1">
                            <div id="switch-button"
                                class="w-[1rem] h-[1rem] bg-[#Ffaeaf] rounded-full cursor-pointer switch" data-value="1"
                                bis_skin_checked="1">
                                <input type="hidden" id="status-field" name="status" value="1">
                            </div>
                        </div>
                        <span id="switch-button-text" class="text-[13px] font-semibold">Usuario Activo</span>
                    </div>

                    <hr>
                    <div class="w-[100%] flex justify-end space-x-[0.5rem] mt-[1rem]" bis_skin_checked="1">
                        <a id="close-edit2"
                            class="bg-[#6a757d] text-[#fff] py-[0.55rem] px-[1rem] cursor-pointer rounded-md">Close
                        </a>
                        <button type="submit" class="bg-[#007bff] text-[#fff] py-[0.5rem] px-[1rem] rounded-md">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>