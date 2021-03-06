<?php

//新增時先讀取資料庫 取得目前學生編號  在UI顯示結果+1 取得最新流水號
require_once("method/pdo-connect.php");
require_once("./public/admin-if-login.php");
$sql_first_number="SELECT *FROM student_list where student_id";
$stmt = $db_host->prepare($sql_first_number);
try{
    $stmt->execute();
    $resultTotal=$stmt->rowCount();

}catch(PDOException $e){
    echo $e->getMessage();
}

//如果表單送出
if(isset($_POST["action"])&&($_POST["action"]=="add")){
    require_once("method/pdo-connect.php");

    $sql_query = "INSERT INTO student_list (student_id ,student_name ,student_gender ,student_birthday ,student_phone ,student_email ,student_address ,s_emergency_contact ,s_emergency_contact_no) VALUES (?, ?, ?, ? ,? ,? ,? ,?, ?)";
    $stmt = $db_host-> prepare($sql_query);

    try{

        $stmt -> execute([$_POST["student_id"], $_POST["student_name"], $_POST["student_gender"], $_POST["student_birthday"], $_POST["student_phone"],$_POST["student_email"],$_POST["student_address"],$_POST["s_emergency_contact"],$_POST["s_emergency_contact_no"]]);


    }catch(PDOException $e){
        echo $e->getMessage();
    }
    //重新導向回到主畫面
    header("Location: student-list.php");
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>Create Student</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php require_once("./public/admin-header-logined.php"); ?>
        <!--menu-->
        <aside class="col-lg-2 navbar-side shadow-sm">
            <?php require_once("./public/nav.php") ?>
        </aside>
        <!--/menu-->
        <div class="col-9 d-flex justify-content-between align-items-center button-group shadow-sm">
            <div>
                <a role="button" href="student-list.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->
            <div>

                <form class="row g-3 mt-5 pb-5 d-flex justify-content-center" method="post">

                        <div class="col-md-5">
                            <!--判斷如果取得目前的筆數讓它+1變成最新-->
                            <?php if(isset($resultTotal)): ?>
                            <label for="student_id" class="form-label">學生編號</label>
                            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="" value="<?=$resultTotal+1?>" readonly>
                            <?php endif?>
                        </div>

                        <div class="col-md-5">
                            <label for="student_name" class="form-label">學生姓名</label>
                            <input type="text" class="form-control" id="student_name" name="student_name" placeholder="請輸入學生姓名" required>
                        </div>

                        <div class="col-md-5">
                            <label for="gender" class="form-label">性別</label>
                            <select id="gender" class="form-select" name="student_gender" aria-label="Default select example" required>
                                <option selected>請選擇性別</option>
                                <option value="1">男生</option>
                                <option value="2">女生</option>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label for="student_birthday" class="form-label">生日</label>
                            <input type="text" class="form-control" id="student_birthday" name="student_birthday" placeholder="請輸入生日" required>
                        </div>

                        <div class="col-md-5">
                            <label for="phone" class="form-label">電話</label>
                            <input type="text" class="form-control" id="phone" name="student_phone" placeholder="請輸入學員電話" required>
                        </div>

                        <div class="col-md-5">
                            <label for="student_email" class="form-label">email</label>
                            <input type="text" class="form-control" id="student_email" name="student_email" placeholder="請輸入email">
                        </div>

                        <div class="col-md-5">
                            <label for="s_emergency_contact" class="form-label">緊急聯絡人</label>
                            <input type="text" class="form-control" id="s_emergency_contact" name="s_emergency_contact" placeholder="請輸入緊急聯絡人姓名" required>
                        </div>

                        <div class="col-md-5">
                            <label for="s_emergency_contact_no" class="form-label">緊急聯絡人電話</label>
                            <input type="text" class="form-control" id="s_emergency_contact_no" name="s_emergency_contact_no" placeholder="請輸入緊急聯絡人電話" required>
                        </div>

                        <div class="col-md-10">
                            <label for="student_address" class="form-label">住址</label>
                            <input type="text" class="form-control" id="student_address" name="student_address" placeholder="請輸入學員住址" required>
                        </div>

                    <div class="col-md-10 d-flex justify-content-end">
                        <div>
                            <input name="action" type="hidden" value="add">
                            <button class="btn btn-primary" type="submit">新增學員資料</button>
                            <button class="btn btn-primary" type="reset">重新填寫</button>
                        </div>
                    </div>
                </form>
            </div>

        </article> <!--/content-->
    </div>
</div>
</body>
</html>