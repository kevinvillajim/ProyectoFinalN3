<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="/assets/logo.jpg" />
    <link rel="stylesheet" href="/styles/index.css" />
    <script src="/scripts/header.js" defer></script>
    <script src="/scripts/alumno/calificacionesAlumno.js" defer></script>

    <!--Tailwind Cambiar a CLI -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts and Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>UNIVERSITY - Dashboard</title>
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
                <h2 class="text-[#fff]">Alumno</h2>
                <h2 class="text-[#fff]"><?php $estudiante = "Marlon Chito Vera";
                                        echo "$estudiante"; ?></h2>
            </div>
            <hr />
            <div class="p-[1rem] space-y-[1rem]">
                <h2 class="text-center text-[#fff]">MENU ALUMNOS</h2>
                <h3 class="text-[#fff] flex cursor-pointer">
                    <span class="material-symbols-outlined mr-[1rem]">
                        <span class="material-symbols-outlined">
                            library_books
                        </span> </span>Ver Calificaciones
                </h3>
                <h3 class="text-[#fff] flex cursor-pointer">
                    <span class="material-symbols-outlined mr-[1rem]">
                        <span class="material-symbols-outlined"> assignment </span> </span>Administra tus Clases
                </h3>
            </div>
        </div>
        <div id="content" class="bg-[#f4f6fb] w-[100%] h-[100%]">
            <header class="w-[100%] h-[4rem] bg-[#fff] flex justify-between items-center px-[1rem] shadow-sm">
                <div id="menu-principal" class="flex cursor-pointer">
                    <span class="material-symbols-outlined"> menu </span>
                    <h2 class="ml-[1rem]">Home</h2>
                </div>
                <div class="flex cursor-pointer" id=show-modal>
                    <h2 class="ml-[1rem]"><?php echo "$estudiante"; ?></h2>
                    <span id="more" class="material-symbols-outlined">expand_more</span>
                </div>
            </header>
            <div id="modal-user" class="bg-[#343b40] bg-opacity-90 absolute right-4 rounded-xl border border-[#E5e5e5] p-[0.5rem]">
                <div class="hover:bg-[#2e2e2e] cursor-pointer rounded-xl p-[0.5rem] my-[1rem] flex items-center">
                    <span class="material-symbols-outlined mr-[0.3rem] text-[#fff]"> person </span>
                    <span class="text-modal text-[#fff]">My Profile</span>
                </div>
                <hr class="border-[#fff]">
                <div class="hover:bg-[#be6570] cursor-pointer rounded-xl p-[0.5rem] flex items-center">
                    <span class="material-symbols-outlined mr-[0.3rem] text-[#fff]"> logout </span>
                    <span class="text-modal text-[#fff]">Logout</span>
                </div>
            </div>
            <div class="p-[1rem]">
                <h1 class="text-[22px] py-[1rem] font-semibold">
                    Calificaciones y mensajes de tus clases
                </h1>
                <div class="bg-[#fff] shadow-lg p-[1rem]">
                    <div class="flex justify-between items-center mb-[0.5rem]">
                        <h3>Calificaciones y mensajes de tus clases</h3>
                    </div>
                    <hr />
                    <div>
                        <div class="flex justify-center items-center my-[0.5rem]">
                            <label for="search" class="mr-[1rem]">Search:</label>
                            <input class="h-[2.3rem] border border-slate-300 rounded-md px-[1rem] text-[#797675]" id="search" name="search" />
                        </div>
                        <table class="w-[100%] table-auto">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">#</th>
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">
                                        Nombre de Clase
                                    </th>
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">
                                        Calificación
                                    </th>
                                    <th class="bg-[#fff] text-[#343b40] h-[3rem]">Mensajes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                ?>
                                <tr>
                                    <td class="h-[3rem] bg-[#f2f2f2]">1</td>
                                    <td class="h-[3rem] bg-[#f2f2f2]">Biología</td>
                                    <td class="h-[3rem] bg-[#f2f2f2]">95</td>
                                    <td class="h-[3rem] bg-[#f2f2f2] flex items-center">
                                        <?php
                                        $newMsg = 2;
                                        if ($newMsg) {
                                            echo "<div class='flex direction-row items-center' id='msg'><span class='material-symbols-outlined cursor-pointer text-[black]'>sms</span><div class='bg-[red] p-[0.15rem] rounded-full text-[10px] text-[#fff] mb-[1.3rem] cursor-pointer'>$newMsg</div></div>";
                                        } else {
                                            echo "<span class='bg-[#16a3b8] p-[0.2rem] text-[#fff] text-[12px] rounded-md'>No hay mensajes</span>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php

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
                <span id="close-modal" class="material-symbols-outlined cursor-pointer"> close </span>
            </div>
            <h1 class="text-[28px] mb-[1rem]">Mensajes</h1>
            <hr />
            <div>
                Mensaje 1...
                <hr />
                <div class="w-[100%] flex justify-end space-x-[0.5rem] mt-[1rem]">
                    <a id="close-modal2" class="bg-[#6a757d] text-[#fff] py-[0.55rem] px-[1rem] cursor-pointer rounded-md">Close
                    </a>
                    <button type="submit" class="bg-[#007bff] text-[#fff] py-[0.5rem] px-[1rem] rounded-md">
                        Nuevo Mensaje
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>