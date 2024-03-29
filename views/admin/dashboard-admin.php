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
    <script src="/scripts/admin/dashboardAdmin.js" defer></script>

    <!--Tailwind Cambiar a CLI -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts and Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>UNIVERSITY - Dashboard Admin</title>
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
                    <?php echo ($_SESSION["user"]["nombre"]); ?>
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
                        <?php echo ($_SESSION["user"]["nombre"]); ?>
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
                <h1 class="text-[22px] py-[1rem] font-semibold">Dashboard</h1>
                <div class="bg-[#fff] shadow-lg p-[1rem]">
                    <h2 class="font-semibold">Bienvenido</h2>
                    <h4>
                        Selecciona la acción que quieras realizar en las pestañas del menu
                        de la izquierda
                    </h4>
                </div>
            </div>
        </div>
    </div>
</body>

</html>