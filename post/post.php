<?php
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location:../login.php");
    }

    require_once '../connect.php';

    error_reporting(E_ALL);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    ini_set('display_errors', 1);

    $query = "SELECT post.*, user.username FROM post, user WHERE post.owner_id = user.id ORDER BY post.id";
    $result = mysqli_query($conn, $query);

    if(isset($_SESSION["message"])){
        echo '<script>alert("'.$_SESSION["message"].'")</script>';
        unset($_SESSION["message"]);
    }

    if (isset($_GET["search_by_owner_name"]) || isset($_GET["search_by_content"])){
        $owner_name = $_GET["search_by_owner_name"];
        $content = $_GET["search_by_content"];
        if(!empty($content)){  //neu co content
            if(empty($owner_name)){ //va ko co owner_name -> tim theo content
                $query = "SELECT post.*, user.username FROM post, user WHERE post.content LIKE '%$content%' AND post.owner_id = user.id ORDER BY post.id";
            }
            else{ //neu co ca 2 -> tim nhung post co content trong so nhung post co cung owner_name
                $query = "SELECT post.*, user.username FROM post, user WHERE (user.username LIKE '%$owner_name%' AND post.content LIKE '%$content%' ) AND post.owner_id = user.id ORDER BY post.id";
            }
        }
        else { //neu ko co content, tim theo owner_name
            if(!empty($owner_name)){
                $query = "SELECT post.*, user.username FROM post, user WHERE user.username LIKE '%$owner_name%' AND post.owner_id = user.id ORDER BY post.id";
            }
        }
        $result = mysqli_query($conn, $query);
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
    <div class="min-h-screen">
        <nav class="bg-emerald-800 border-b border-gray-100 select-none">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 flex flex-row justify-between">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/post/post.php">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                                    viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1"
                                        stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                        stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="none"></path>
                                        <g>
                                            <path
                                                d="M45.58,159.96c-14.70084,0 -26.66,-11.95916 -26.66,-26.66v-87.72c0,-14.70084 11.95916,-26.66 26.66,-26.66h87.72c14.70084,0 26.66,11.95916 26.66,26.66v87.72c0,14.70084 -11.95916,26.66 -26.66,26.66z"
                                                fill="#000000" opacity="0.35"></path>
                                            <path
                                                d="M42.14,156.52c-14.70084,0 -26.66,-11.95916 -26.66,-26.66v-87.72c0,-14.70084 11.95916,-26.66 26.66,-26.66h87.72c14.70084,0 26.66,11.95916 26.66,26.66v87.72c0,14.70084 -11.95916,26.66 -26.66,26.66z"
                                                fill="#f2f2f2"></path>
                                            <path
                                                d="M129.86,26.66h-87.72c-8.55012,0 -15.48,6.92988 -15.48,15.48v87.72c0,8.55012 6.92988,15.48 15.48,15.48h87.72c8.55012,0 15.48,-6.92988 15.48,-15.48v-87.72c0,-8.55012 -6.92988,-15.48 -15.48,-15.48z"
                                                fill="#ffc571"></path>
                                            <path
                                                d="M126.8844,143.1384h-82.0354c-0.75508,-4.16928 -1.57036,-10.36472 -1.57036,-18.1288c0,-15.10848 0,-33.23728 0,-33.23728c0,0 4.3516,-22.32904 9.73004,-28.97684c5.04648,-6.22468 8.34028,-10.51436 20.48692,-13.32484c9.0644,-2.1156 21.543,-0.69488 27.1932,3.02204c6.49644,4.2914 10.1824,20.15324 11.51196,34.11276c4.50296,-0.90644 15.74316,0.60372 16.61864,3.86828c4.773,17.28084 0.51256,41.51392 -1.935,52.66468z"
                                                fill="#f4665c"></path>
                                            <path
                                                d="M127.9422,143.1384h-81.67248c-0.66392,-8.0668 -1.44996,-21.3022 -1.48092,-38.4334c2.50776,12.62996 4.92436,28.97684 21.09064,29.58056c10.51436,0.36292 24.98816,1.66152 29.70268,-7.40288c4.74376,-9.0644 11.2402,-27.04356 10.60552,-47.1968c-0.57448,-17.64548 -5.28728,-24.7766 -6.43624,-26.28676c1.78192,1.99348 11.3004,13.56736 12.11568,35.35288c0.09116,2.50776 0.1806,5.19784 0.24252,8.03756c12.72112,-0.45408 17.91724,4.5322 18.34036,7.10016c2.50776,14.62172 -0.15136,29.88156 -2.50776,39.24868z"
                                                fill="#de5147"></path>
                                            <path
                                                d="M115.79556,98.32896c0,11.08884 -0.84624,33.841 -1.26936,44.80944h-6.04236c0.42312,-10.81708 1.26936,-33.75156 1.26936,-44.80944c0,-16.73904 -4.4118,-38.22184 -10.72592,-42.36188c-4.98628,-3.26284 -16.58768,-4.472 -24.86776,-2.56796c-10.93748,2.50776 -13.80816,6.01312 -18.55192,11.84392l-0.24252,0.30272c-3.95772,4.83492 -7.826,20.90832 -9.0644,27.0728v32.63184c0,7.79504 0.84624,13.92856 1.63228,17.888h-6.16448c-0.75508,-4.26044 -1.51016,-10.33376 -1.51016,-17.888l0.0602,-33.50904c0.45408,-2.32716 4.68356,-23.05488 10.36472,-30.03464l0.24252,-0.27176c4.98628,-6.13352 8.944,-10.96844 21.90592,-13.92856c9.91064,-2.2962 23.17528,-0.75508 29.52036,3.4142c9.7868,6.40528 13.44352,32.48048 13.44352,47.40836z"
                                                fill="#40396e"></path>
                                            <path
                                                d="M61.90624,68.45428c15.7638,-0.16684 28.37484,0.85484 27.1932,18.1632c-1.18164,17.30664 -25.61596,16.7184 -28.37484,16.12672c-2.75888,-0.59168 -23.64656,-0.13072 -23.2544,-16.12672c0.39732,-15.99772 13.79956,-18.0514 24.43604,-18.1632z"
                                                fill="#2785bd"></path>
                                            <path
                                                d="M133.1366,129.17888c-0.84624,6.01312 -2.08464,10.66572 -3.68596,13.95952h-7.34268c0.75508,-0.57448 3.4142,-3.354 5.04648,-14.80576c1.72172,-12.08644 -0.69488,-35.62464 -2.81048,-38.61572c-1.20916,-1.20916 -7.9464,-2.4166 -13.20444,-2.68836l0.30272,-6.01312c3.14244,0.15136 13.68776,0.9374 17.25332,4.50296c4.28968,4.31892 6.10256,32.0264 4.44104,43.66048z"
                                                fill="#40396e"></path>
                                            <path
                                                d="M40.72272,77.271c0.78948,6.22124 -0.59168,10.12564 7.68324,10.71388c8.27492,0.58824 24.40164,3.08912 28.40924,-1.67356c4.0076,-4.76268 5.28728,-13.18896 -2.6918,-15.91516c-5.65708,-1.92984 -24.92624,-5.06024 -33.40068,6.87484z"
                                                fill="#70bfff"></path>
                                            <path
                                                d="M63.26676,105.90384c-1.51704,0 -2.63848,-0.09116 -3.17856,-0.20812c-0.25972,-0.05676 -0.7138,-0.10492 -1.31064,-0.1806c-16.14736,-2.05196 -24.33284,-8.41252 -24.3294,-18.89936c0.00344,-8.1528 3.5346,-21.8698 27.15192,-22.11748l0.54696,-0.00688c10.406,-0.11524 19.38096,-0.20468 24.99504,5.49368c3.54492,3.59824 5.17376,9.0644 4.97596,16.7098c-0.13244,5.0998 -2.37188,9.50816 -6.47752,12.74176c-6.75272,5.3148 -17.01768,6.4672 -22.37376,6.4672zM61.66716,70.53892c-21.16976,0.2236 -21.17492,12.15524 -21.17492,16.07684c-0.00344,9.39464 10.87212,11.86284 19.05072,12.90172c0.8256,0.10492 1.44996,0.19092 1.81632,0.26832c1.70108,0.30444 14.14012,0.10492 20.71224,-5.23396c2.6144,-2.12076 3.92504,-4.74376 4.00588,-8.01692c0.1548,-5.9168 -0.90988,-9.94332 -3.2422,-12.31348c-3.81324,-3.87 -11.5842,-3.7926 -20.6228,-3.69284z"
                                                fill="#40396e"></path>
                                            <path
                                                d="M55.60072,73.77252c5.91336,-0.98556 15.47656,-1.59788 13.40052,3.94052c-1.47748,3.94052 -21.70984,6.60136 -21.70984,1.9694c0,-4.62852 8.30932,-5.90992 8.30932,-5.90992z"
                                                fill="#d9eeff"></path>
                                            <path
                                                d="M129.86,147.92h-87.72c-9.9588,0 -18.06,-8.1012 -18.06,-18.06v-87.72c0,-9.9588 8.1012,-18.06 18.06,-18.06h87.72c9.9588,0 18.06,8.1012 18.06,18.06v87.72c0,9.9588 -8.1012,18.06 -18.06,18.06zM42.14,29.24c-7.11392,0 -12.9,5.78608 -12.9,12.9v87.72c0,7.11392 5.78608,12.9 12.9,12.9h87.72c7.11392,0 12.9,-5.78608 12.9,-12.9v-87.72c0,-7.11392 -5.78608,-12.9 -12.9,-12.9z"
                                                fill="#40396e"></path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="space-x-8 -my-px ml-10 flex">

                            <a class="inline-flex items-center px-1 pt-1 border-b-4 border-blue-400 text-sm font-medium leading-5 text-blue-50 hover:text-blue-50 hover:border-blue-300 focus:outline-none focus:border-indigo-700 transition"
                                href="./post.php">
                                Post
                            </a>
                            <?php if($_SESSION['type'] === '1') {
                                echo '<a class="inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-sm font-medium leading-5 text-white hover:text-blue-50 hover:border-blue-300 focus:outline-none focus:text-emerald-200 focus:border-gray-300 transition"
                                    href="../account/account.php">
                                        Tài khoản
                                    </a>';
                                }
                            ?>
                        </div>

                    </div>
                </div>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-gray-100 md:p-0 md:w-auto"><?php echo($_SESSION["username"]) ?><svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="../user_setting.php" class="block py-2 px-4 hover:bg-gray-100">Cài đặt</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="../logout.php" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Đăng xuất</a>
                        </div>
                    </div>
                </li>
            </div>
        </nav>



        <!-- Page Content -->
        <main>
            <div class="w-full flex flex-row mx-auto py-12 justify-center">
                <div class="w-auto overflow-hidden px-10 py-5 bg-gray-100 shadow-lg">
                    <div class="w-full flex flex-col select-none">
                        <div class="w-full items-center divide-gray-300 divide-y divide-solid">
                            <div>
                                <?php
                                if(isset($_GET["search_by_owner_name"]) || isset($_GET["search_by_content"])) {echo "Kết quả tìm kiếm theo: ";} if(!empty($owner_name)) {echo "Tên người đăng: ".$owner_name; } if(!empty($content)) { echo " Nội dung: ".$content; }
                                ?>
                            </div>

                            <div class="w-full select-none flex flex-row justify-end space-x-4 mb-4 pr-2">
                                <a href="./post_create.php">
                                    <button type="button"
                                        class="text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2 bg-green-500 hover:bg-green-600 focus:ring-green-300 w-30">
                                        Tạo bài viết
                                    </button>
                                </a>
                            </div>

                            <form method="GET">
                            <div class="h-auto w-full flex flex-row items-center pt-4 space-x-8">
                                
                                    <div class="flex w-auto items-center justify-start space-x-6">
                                        <label for="search_by_owner_name" class="w-48">
                                            Tìm theo tên người đăng
                                        </label>
                                        <input name="search_by_owner_name" id="search_by_owner_name" type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                                    </div>

                                    <div class="flex w-full items-center space-x-3 justify-start space-x-4">
                                        <label for="search_by_content">
                                            Tìm theo nội dung
                                        </label>
                                        <input name="search_by_content" id="search_by_content" type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                                    </div>
                                    <div class="flex flex-row items-center">
                                        <button type="submit" class="bg-orange-400 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 text-white hover:text-white hover:bg-orange-500 focus:ring-yellow-300 w-28">
                                            Tìm kiếm
                                        </button>
                                    </div>
                            </div>
                            </form>

                        </div>

                        <div class="flex flex-col mb-4 pt-2">
                            <div class="overflow-x-auto w-full">
                                <div class="py-2 align-middle inline-block min-w-full">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                                        ID
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                                        Tiêu đề
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                                        Nội dung
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                                        Người đăng
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                                        Thời gian đăng
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                                        Thời gian chỉnh sửa gần nhất
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                                                        Tùy chọn
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php 
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap select-text">
                                                        <div class="flex items-center">
                                                            <span class="text-sm font-medium text-gray-900">
                                                                <?php echo $row['id'] ?>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900 truncate w-32">
                                                            <?php echo $row['title'] ?>
                                                            <div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 italic truncate w-80">
                                                            <?php echo $row['content'] ?>
                                                            <div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap select-text">
                                                        <div class="flex items-center">
                                                            <span class="text-sm font-medium text-gray-900">
                                                                <?php echo $row['username'] ?>
                                                            </span>
                                                        </div>
                                                    </td>


                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <?php echo $row['created_time'] ?>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <?php echo $row['last_updated_time'] ? $row['last_updated_time'] : 'Không có thông tin'  ?>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <?php
                                                                if($row['owner_id'] == $_SESSION['id']){
                                                                    echo '<a href="./post_edit.php?id='.$row['id'].'">Chỉnh sửa</a> |'.
                                                                         '<a href="./post_delete.php?id='.$row['id'].'" onclick='.'"return confirm(\'Chắc chắn muốn xóa bài viết này?\');"> Xóa</a>';
                                                                    }
                                                            ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php }} else {
                                                    echo '
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap" colspan="7">
                                                            <div class="text-sm text-gray-500 flex justify-center">
                                                                Không có thông tin.
                                                            </div>
                                                        </td>
                                                    </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>

    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
</body>

</html>