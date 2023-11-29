<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="/assets/logo.jpg" />


    <!--Tailwind Cambiar a CLI -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts and Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>UNIVERSITY - Login</title>
</head>

<body>
    <div class="w-screen h-screen bg-[#fff4d3]">
        <div class="flex flex-col items-center">
            <img class="w-[10rem] my-[1rem]" src="/assets/logo.jpg" alt="logo" />
            <div class="w-[20rem] p-[1rem] bg-[#fff] text-center space-y-[0.75rem] shadow-lg">
                <h2 class="text-[#797675]">Bienvenido Ingresa con tu cuenta</h2>
                <div>
                    <form method="post" action="/login" id="form-login" class="space-y-[0.75rem] relative">
                        <div class="relative">
                            <?php if (isset($errorMessage)): ?>
                            <span class='text-[red] text-[13px] font-semibold'>
                                <?= $errorMessage ?>
                            </span>
                            <?php endif; ?>
                            <input
                                class="w-[100%] h-[2.3rem] border border-slate-300 rounded-md px-[1rem] text-[#797675]"
                                type="email" name="email" placeholder="Email" />
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-1/2 transform -translate-y-1/2 text-[#797675]">
                                mail
                            </span>
                        </div>
                        <div class="relative">
                            <input
                                class="w-[100%] h-[2.3rem] border border-slate-300 rounded-md px-[1rem] text-[#797675]"
                                type="password" name="password" placeholder="Password" />
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-1/2 transform -translate-y-1/2 text-[#797675]">
                                lock
                            </span>
                        </div>
                        <div class="w-[100%] flex justify-end">
                            <input class="py-[0.4rem] px-[0.8rem] bg-[#017cff] text-[#fff] rounded-md" type="submit"
                                value="Ingresar" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-[#fff] opacity-25 mt-[1rem] rounded-md shadow-md hover:opacity-100">
                <h3 class="px-[1rem] py-[0.5rem] font-bold">Información de Acceso</h3>
                <hr />
                <div class="px-[1rem] py-[0.5rem] space-y-[0.15rem]">
                    <h3 class="font-bold">Admin</h3>
                    <h5>user: admin@admin</h5>
                    <h5>pass: admin</h5>
                    <h3 class="font-bold">Maestros</h3>
                    <h5>user: maestro@maestro</h5>
                    <h5>pass: maestro</h5>
                    <h3 class="font-bold">Alumno</h3>
                    <h5>user: alumno@alumno</h5>
                    <h5>pass: alumno</h5>
                </div>
            </div>
        </div>
    </div>
</body>

</html>