<?php
    require_once 'connect.php';

    $message = "";
    $error_register = false;

    if(isset($_POST['register_submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];

        if($password != $re_password){
            $message = '<label id="message" class="text-red-500 italic pr-1">Mật khẩu không khớp.</label>';
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO user( username, password ) VALUES ( '$username', '$password');";

            if($conn->query($query) === false) {
                $message = '<label id="message" class="text-red-500 italic pr-1">Xảy ra lỗi, đăng ký thất bại.</label>';
            } else{
                $message = '<label id="message" class="text-green-500 italic pr-1">Đăng ký thành công.</label>';
            }
        }
    }
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">

</head>

<body class="antialiased">
    <div class="h-screen flex flex-col">
        <nav class="bg-emerald-800 border-b border-gray-100 select-none">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/post/post.php">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="40" height="40"viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M45.58,159.96c-14.70084,0 -26.66,-11.95916 -26.66,-26.66v-87.72c0,-14.70084 11.95916,-26.66 26.66,-26.66h87.72c14.70084,0 26.66,11.95916 26.66,26.66v87.72c0,14.70084 -11.95916,26.66 -26.66,26.66z" fill="#000000" opacity="0.35"></path><path d="M42.14,156.52c-14.70084,0 -26.66,-11.95916 -26.66,-26.66v-87.72c0,-14.70084 11.95916,-26.66 26.66,-26.66h87.72c14.70084,0 26.66,11.95916 26.66,26.66v87.72c0,14.70084 -11.95916,26.66 -26.66,26.66z" fill="#f2f2f2"></path><path d="M129.86,26.66h-87.72c-8.55012,0 -15.48,6.92988 -15.48,15.48v87.72c0,8.55012 6.92988,15.48 15.48,15.48h87.72c8.55012,0 15.48,-6.92988 15.48,-15.48v-87.72c0,-8.55012 -6.92988,-15.48 -15.48,-15.48z" fill="#ffc571"></path><path d="M126.8844,143.1384h-82.0354c-0.75508,-4.16928 -1.57036,-10.36472 -1.57036,-18.1288c0,-15.10848 0,-33.23728 0,-33.23728c0,0 4.3516,-22.32904 9.73004,-28.97684c5.04648,-6.22468 8.34028,-10.51436 20.48692,-13.32484c9.0644,-2.1156 21.543,-0.69488 27.1932,3.02204c6.49644,4.2914 10.1824,20.15324 11.51196,34.11276c4.50296,-0.90644 15.74316,0.60372 16.61864,3.86828c4.773,17.28084 0.51256,41.51392 -1.935,52.66468z" fill="#f4665c"></path><path d="M127.9422,143.1384h-81.67248c-0.66392,-8.0668 -1.44996,-21.3022 -1.48092,-38.4334c2.50776,12.62996 4.92436,28.97684 21.09064,29.58056c10.51436,0.36292 24.98816,1.66152 29.70268,-7.40288c4.74376,-9.0644 11.2402,-27.04356 10.60552,-47.1968c-0.57448,-17.64548 -5.28728,-24.7766 -6.43624,-26.28676c1.78192,1.99348 11.3004,13.56736 12.11568,35.35288c0.09116,2.50776 0.1806,5.19784 0.24252,8.03756c12.72112,-0.45408 17.91724,4.5322 18.34036,7.10016c2.50776,14.62172 -0.15136,29.88156 -2.50776,39.24868z" fill="#de5147"></path><path d="M115.79556,98.32896c0,11.08884 -0.84624,33.841 -1.26936,44.80944h-6.04236c0.42312,-10.81708 1.26936,-33.75156 1.26936,-44.80944c0,-16.73904 -4.4118,-38.22184 -10.72592,-42.36188c-4.98628,-3.26284 -16.58768,-4.472 -24.86776,-2.56796c-10.93748,2.50776 -13.80816,6.01312 -18.55192,11.84392l-0.24252,0.30272c-3.95772,4.83492 -7.826,20.90832 -9.0644,27.0728v32.63184c0,7.79504 0.84624,13.92856 1.63228,17.888h-6.16448c-0.75508,-4.26044 -1.51016,-10.33376 -1.51016,-17.888l0.0602,-33.50904c0.45408,-2.32716 4.68356,-23.05488 10.36472,-30.03464l0.24252,-0.27176c4.98628,-6.13352 8.944,-10.96844 21.90592,-13.92856c9.91064,-2.2962 23.17528,-0.75508 29.52036,3.4142c9.7868,6.40528 13.44352,32.48048 13.44352,47.40836z" fill="#40396e"></path><path d="M61.90624,68.45428c15.7638,-0.16684 28.37484,0.85484 27.1932,18.1632c-1.18164,17.30664 -25.61596,16.7184 -28.37484,16.12672c-2.75888,-0.59168 -23.64656,-0.13072 -23.2544,-16.12672c0.39732,-15.99772 13.79956,-18.0514 24.43604,-18.1632z" fill="#2785bd"></path><path d="M133.1366,129.17888c-0.84624,6.01312 -2.08464,10.66572 -3.68596,13.95952h-7.34268c0.75508,-0.57448 3.4142,-3.354 5.04648,-14.80576c1.72172,-12.08644 -0.69488,-35.62464 -2.81048,-38.61572c-1.20916,-1.20916 -7.9464,-2.4166 -13.20444,-2.68836l0.30272,-6.01312c3.14244,0.15136 13.68776,0.9374 17.25332,4.50296c4.28968,4.31892 6.10256,32.0264 4.44104,43.66048z" fill="#40396e"></path><path d="M40.72272,77.271c0.78948,6.22124 -0.59168,10.12564 7.68324,10.71388c8.27492,0.58824 24.40164,3.08912 28.40924,-1.67356c4.0076,-4.76268 5.28728,-13.18896 -2.6918,-15.91516c-5.65708,-1.92984 -24.92624,-5.06024 -33.40068,6.87484z" fill="#70bfff"></path><path d="M63.26676,105.90384c-1.51704,0 -2.63848,-0.09116 -3.17856,-0.20812c-0.25972,-0.05676 -0.7138,-0.10492 -1.31064,-0.1806c-16.14736,-2.05196 -24.33284,-8.41252 -24.3294,-18.89936c0.00344,-8.1528 3.5346,-21.8698 27.15192,-22.11748l0.54696,-0.00688c10.406,-0.11524 19.38096,-0.20468 24.99504,5.49368c3.54492,3.59824 5.17376,9.0644 4.97596,16.7098c-0.13244,5.0998 -2.37188,9.50816 -6.47752,12.74176c-6.75272,5.3148 -17.01768,6.4672 -22.37376,6.4672zM61.66716,70.53892c-21.16976,0.2236 -21.17492,12.15524 -21.17492,16.07684c-0.00344,9.39464 10.87212,11.86284 19.05072,12.90172c0.8256,0.10492 1.44996,0.19092 1.81632,0.26832c1.70108,0.30444 14.14012,0.10492 20.71224,-5.23396c2.6144,-2.12076 3.92504,-4.74376 4.00588,-8.01692c0.1548,-5.9168 -0.90988,-9.94332 -3.2422,-12.31348c-3.81324,-3.87 -11.5842,-3.7926 -20.6228,-3.69284z" fill="#40396e"></path><path d="M55.60072,73.77252c5.91336,-0.98556 15.47656,-1.59788 13.40052,3.94052c-1.47748,3.94052 -21.70984,6.60136 -21.70984,1.9694c0,-4.62852 8.30932,-5.90992 8.30932,-5.90992z" fill="#d9eeff"></path><path d="M129.86,147.92h-87.72c-9.9588,0 -18.06,-8.1012 -18.06,-18.06v-87.72c0,-9.9588 8.1012,-18.06 18.06,-18.06h87.72c9.9588,0 18.06,8.1012 18.06,18.06v87.72c0,9.9588 -8.1012,18.06 -18.06,18.06zM42.14,29.24c-7.11392,0 -12.9,5.78608 -12.9,12.9v87.72c0,7.11392 5.78608,12.9 12.9,12.9h87.72c7.11392,0 12.9,-5.78608 12.9,-12.9v-87.72c0,-7.11392 -5.78608,-12.9 -12.9,-12.9z" fill="#40396e"></path></g></g></svg>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="space-x-8 -my-px ml-10 flex">
                            <a class="inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-sm font-medium leading-5 text-white hover:text-blue-50 hover:border-blue-300 focus:outline-none focus:text-emerald-200 focus:border-gray-300 transition"
                                href="/login.php">
                                Đăng nhập
                            </a>
                            <a class="inline-flex items-center px-1 pt-1 border-b-4 border-blue-400 text-sm font-medium leading-5 text-blue-50 hover:text-blue-50 hover:border-blue-300 focus:outline-none focus:border-indigo-700 transition"
                               href="/register.php">
                                Đăng ký
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="h-full bg-cover" style="background-image: url('img/login-background.jpg')">
            <div class="h-full w-auto mx-auto flex items-center justify-center">
                <div class="w-2/5 h-auto bg-gray-100 overflow-hidden shadow-xl px-10 py-5 rounded-lg">
                    <form action="register.php" enctype="multipart/form-data" method="POST" class="w-full px-7 py-5 flex items-center flex-col">
                        <div class="mb-6 flex flex-row w-full">
                            <label for="username" class="w-1/3 flex justify-start items-center">
                                Tài khoản
                            </label>
                            <input type="text" id="username" name="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required="">
                        </div>
                        <div class="mb-6 flex flex-row w-full">
                            <label for="password" class="w-1/3 flex justify-start items-center">
                                Mật khẩu
                            </label>
                            <input type="password" id="password" name="password"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   required="">
                        </div>
                        <div class="w-full flex flex-col mb-6 space-y-3">
                            <div class="flex flex-row w-full">
                                <label for="re_password" class="w-1/3 flex justify-start items-center">
                                    Nhập lại mật khẩu
                                </label>
                                <input type="password" id="re_password" name="re_password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required="">
                            </div>
                            <?php if(!empty($message)){
                                    echo '
                                    <div class="w-full flex justify-end">'
                                        .$message.
                                    '</div>'
                                ;}
                            ?>

                        </div>

                        <button type="submit" name="register_submit" class="w-3/6 text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Đăng ký
                        </button>
                    </form>

                </div>
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>

</body>

</html>