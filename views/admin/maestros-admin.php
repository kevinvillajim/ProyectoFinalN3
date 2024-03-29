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
    <script src="/scripts/admin/maestrosAdmin.js" defer></script>
    <!--Tailwind Cambiar a CLI -->
    <script src="https://cdn.tailwindcss.com">
    </script>

    <!-- Google Fonts and Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>UNIVERSITY - Maestros</title>
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
                        <?= $admin ?>
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
                <h1 class="text-[22px] py-[1rem] font-semibold">Lista de Maestros</h1>
                <div class="bg-[#fff] shadow-lg p-[1rem]">
                    <div class="flex justify-between items-center mb-[0.5rem]">
                        <h3>Información de Maestros</h3>
                        <button id="create-new" type="button"
                            class="bg-[#017cfe] text-[#fff] py-[0.3rem] px-[0.6rem] rounded-md">
                            Agregar Maestro
                        </button>
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
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">Nombre</th>
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">Email</th>
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">Dirección</th>
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">
                                        Nacimiento
                                    </th>
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">
                                        Clase Asignada
                                    </th>
                                    <th class="bg-[#fff] text-[#000632] h-[3rem] w-[7%]">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($maestros as $maestro) {
                                    ?>
                                <tr>
                                    <td class="h-[3rem] bg-[#f2f2f2]">
                                        <?= $maestro["id"] ?>
                                    </td>
                                    <td class="h-[3rem] bg-[#f2f2f2]">
                                        <?= $maestro["nombre"] ?>
                                    </td>
                                    <td class="h-[3rem] bg-[#f2f2f2]">
                                        <?= $maestro["email"] ?>
                                    </td>
                                    <td class="h-[3rem] bg-[#f2f2f2]">
                                        <?= $maestro["direccion"] ?>
                                    </td>
                                    <td class="h-[3rem] bg-[#f2f2f2]">
                                        <?= $maestro["nacimiento"] ?>
                                    </td>
                                    <td class="h-[3rem] bg-[#f2f2f2]">
                                        <?php
                                            if (isset($maestro["nombreClase"])) {
                                                echo $maestro["nombreClase"];
                                            } else {
                                                echo "<span class='text-[12px] bg-[#cba51a] p-[0.2rem] rounded-md'>Sin asignación</span>";
                                            }
                                            ?>
                                    </td>
                                    <td class="h-[3rem] bg-[#f2f2f2] flex justify-evenly items-center">
                                        <span data-maestro-id="<?= $maestro["id"] ?>"
                                            class="material-symbols-outlined cursor-pointer text-[#FFC300] edit-new">
                                            edit
                                        </span>
                                        <form action="" method="POST">
                                            <input type="hidden" name=action value="delete" />
                                            <input type="number" hidden value="<?= $maestro["id"] ?>" name="id" />
                                            <button type="submit" class="bg-[none] border-[none]">
                                                <span class="material-symbols-outlined cursor-pointer text-[red]">
                                                    delete
                                                </span>
                                            </button>
                                        </form>
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
    </div>
    <div id="create" class="w-screen h-screen bg-[#000] bg-opacity-50 absolute top-0 grid place-content-center">
        <div class="w-[25rem] p-[1rem] bg-[#fff] shadow-xl opacity-100">
            <div class="flex justify-end">
                <span id="close-create" class="material-symbols-outlined cursor-pointer"> close </span>
            </div>
            <h1 class="text-[28px] mb-[1rem]">Agregar Maestro</h1>
            <hr />
            <div>
                <form action="" method="POST" class="space-y-[0.5rem] my-[1rem]">
                    <label for="email-create" class="text-[13px] font-semibold">Email</label>
                    <input type="email" name="email-create" id="email-create" placeholder="Ingrese el email"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]" />
                    <label for="name-create" class="text-[13px] font-semibold">Nombre(s)</label>
                    <input name="name-create" id="name-create" placeholder="Ingrese los nombre(s)"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]" />
                    <label for="apellido-create" class="text-[13px] font-semibold">Apellido(s)</label>
                    <input name="apellido-create" id="apellido-create" placeholder="Ingrese apellido(s)"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]" />
                    <label for="apellido-create" class="text-[13px] font-semibold">Dirección</label>
                    <input name="direccion-create" id="direccion-create" placeholder="Ingrese la direccion"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]" />
                    <label for="birth-create" class="text-[13px] font-semibold">Fecha de nacimiento</label>
                    <input type="date" name="birth-create" id="birth-create" placeholder="mm/dd/yyyy"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]" />
                    <label for="clase-create" class="text-[13px] font-semibold">Clase Asignada</label>
                    <select name="clase-create" id="clase-create"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]">
                        <option selected hidden>Selecciona la Clase</option>
                        <?php
                        foreach ($clases as $clase) {
                            ?>
                        <option value="<?php echo $clase["id"] ?>">
                            <?php echo $clase["clase"] ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="hidden" name="action" value="create" />
                    <hr />
                    <div class="w-[100%] flex justify-end space-x-[0.5rem] mt-[1rem]">
                        <a id="close-create2"
                            class="bg-[#6a757d] text-[#fff] py-[0.55rem] px-[1rem] cursor-pointer rounded-md">Close
                        </a>
                        <button type="submit" class="bg-[#007bff] text-[#fff] py-[0.5rem] px-[1rem] rounded-md">
                            Crear
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    var maestros = <?php echo json_encode($maestros) ?>;
    </script>
    <?php
    foreach ($maestros as $maestro) {
        ?>
    <div id="edit" class="w-screen h-screen bg-[#000] bg-opacity-50 absolute top-0 grid place-content-center modal">
        <div class="w-[25rem] p-[1rem] bg-[#fff] shadow-xl opacity-100">
            <div class="flex justify-end">
                <span id="close-edit" class="material-symbols-outlined cursor-pointer close"> close </span>
            </div>
            <h1 class="text-[28px] mb-[1rem]">Editar maestro</h1>
            <hr />
            <div id="modal-edit" class="modal">
                <form id="form-edit" action="" method="POST" class="space-y-[0.5rem] my-[1rem]">
                    <input type="hidden" id="maestro-id-edit" name="maestro-id-edit" />
                    <label for="email-edit" class="text-[13px] font-semibold">Email</label>
                    <input type="email" name="email-edit" id="email-edit"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]" />
                    <label for="name-edit" class="text-[13px] font-semibold">Nombre(s)</label>
                    <input name="name-edit" id="name-edit"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]" />
                    <label for="apellido-edit" class="text-[13px] font-semibold">Apellido(s)</label>
                    <input name="apellido-edit" id="apellido-edit" placeholder="Ingrese apellido(s)"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]" />
                    <label for="apellido-edit" class="text-[13px] font-semibold">Dirección</label>
                    <input name="direccion-edit" id="direccion-edit"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]" />
                    <label for="birth-edit" class="text-[13px] font-semibold">Fecha de nacimiento</label>
                    <input type="date" name="birth-edit" id="birth-edit"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]" />
                    <label for="clase-edit" class="text-[13px] font-semibold">Clase Asignada</label>
                    <select name="clase-edit" id="clase-edit"
                        class="w-[100%] h-[2rem] border border-slate-300 rounded-md px-[0.8rem] text-[#797675]">
                        <option selected hidden>Selecciona la Clase</option>
                        <?php
                            foreach ($clases as $clase) {
                                ?>
                        <option value="<?php echo $clase["id"] ?>">
                            <?php echo $clase["clase"] ?>
                        </option>
                        <?php
                            }
                            ?>
                    </select>
                    <input type=hidden name="action" value="update" />
                    <hr />
                    <div class="w-[100%] flex justify-end space-x-[0.5rem] mt-[1rem]">
                        <a id="close-edit2"
                            class="bg-[#6a757d] text-[#fff] py-[0.55rem] px-[1rem] cursor-pointer rounded-md close">Close
                        </a>
                        <button type="submit" class="bg-[#007bff] text-[#fff] py-[0.5rem] px-[1rem] rounded-md">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</body>

</html>