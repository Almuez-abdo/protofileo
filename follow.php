<?php
    ob_start();
    session_start();

    $pageTitle  = "حاسبة تكلفة تصميم الموقع" ;
    $current_page = basename($_SERVER['PHP_SELF']);
     include "includes/func/function.php";
     include "includes/header.php";
     include "includes/nav.php";

// التحقق من وجود إجابة من قبل
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['site_type'])) {
        $_SESSION['site_type'] = $_POST['site_type']; // حفظ نوع الموقع
    }
    if (isset($_POST['pages'])) {
        $_SESSION['pages'] = $_POST['pages']; // حفظ عدد الصفحات
    }
    if (isset($_POST['admin_panel'])) {
        $_SESSION['admin_panel'] = $_POST['admin_panel']; // حفظ خيار لوحة التحكم
    }
    if (isset($_POST['hosting'])) {
        $_SESSION['hosting'] = $_POST['hosting']; // حفظ خيار الاستضافة
    }
    if (isset($_POST['dataBes'])) {
        $_SESSION['dataBes'] = $_POST['dataBes']; // حفظ خيار قاعدة البيانات
    }
    if (isset($_POST['desing'])) {
        $_SESSION['desing'] = $_POST['desing']; // حفظ خيار التصميم
    }
}

// حساب التكلفة بناءً على الإجابات
$total = 0;
if (isset($_SESSION['site_type'])) {
    // أسعار المواقع
    if ($_SESSION['site_type'] == "landing") $total += 100;
    elseif ($_SESSION['site_type'] == "company") $total += 300;
    elseif ($_SESSION['site_type'] == "store") $total += 800;
    elseif ($_SESSION['site_type'] == "blog") $total += 250;
}

if (isset($_SESSION['pages'])) {
    // تكلفة الصفحات
    $total += $_SESSION['pages'] * 50;
}

if (isset($_SESSION['admin_panel']) && $_SESSION['admin_panel'] == "yes") {
    // تكلفة لوحة التحكم
    $total += 200;
}

if (isset($_SESSION['hosting']) && $_SESSION['hosting'] == "yes") {
    // تكلفة الاستضافة
    $total += 100;
}

if (isset($_SESSION['dataBes']) && $_SESSION['dataBes'] == "yes") {
    // تكلفة قاعدة البيانات
    $total += 100;
}

if (isset($_SESSION['desing']) && $_SESSION['desing'] == "no") {
    // تكلفة التصميم
    $total += 100;
}

?>

    
    <div id="part" class="pf-wrap">
    <div class="pf-card follow-card">
        <span class="pf-kicker">Free estimate</span>
        <h1>Website Cost Calculator</h1>
        <p class="pf-sub" style="margin-bottom:10px">Answer a few questions to get an instant ballpark estimate.</p>

        <form method="POST" style="display: grid">
            <?php
            // تحديد الخطوة الحالية بناءً على الجلسة
            if (!isset($_SESSION['site_type'])) {
                // الخطوة 1: نوع الموقع
            ?>    
                <label class="lableQ" style="display: grid" for="site_type">  1. نوع الموقع المطلوب :
                <select class="optionQ" name="site_type" id="site_type" required>
                    <option value="">اختر...</option>
                    <option value="landing">صفحة هبوط (Landing Page)</option>
                    <option value="company">موقع شركة</option>
                    <option value="store">متجر إلكتروني</option>
                    <option value="blog">مدونة</option>
                </select>
                <button class="buttonQ " type="submit">التالي</button>
            <?php
            } elseif (!isset($_SESSION['pages'])) {
                // الخطوة 2: عدد الصفحات
            ?>
                <label class="lableQ" style="display: grid" for="pages">2. عدد الصفحات المطلوبة:</label>
                <input class="optionQ" type="number" name="pages" id="pages" value="1" min="1" required>
                <button class="buttonQ" type="submit">التالي</button>
            <?php
            } elseif (!isset($_SESSION['admin_panel'])) {
                // الخطوة 3: لوحة التحكم
            ?>
                <label class="lableQ" style="display: grid"> هل تحتاج الي لوحة تحكم؟ </label>
                <div class="choose"><span>نعم</span><input class="optionQ" type="radio" name="admin_panel" value="yes"></div> 
                <div class="choose"><span>لا</span><input class="optionQ" type="radio" name="admin_panel" value="no"></div>
                <button class="buttonQ" type="submit">التالي</button>
            <?php
            } elseif (!isset($_SESSION['dataBes'])) {
                // الخطوة 4: قاعدة البيانات
            ?>
                <label class="lableQ" style="display: grid"> هل تحتاج الي قاعدة بيانات؟ </lable>
                <div class="choose"><span>نعم</span><input class="optionQ" type="radio" name="dataBes" value="yes"></div> 
                <div class="choose"><span>لا</span><input class="optionQ" type="radio" name="dataBes" value="no"></div>
                <button class="buttonQ" type="submit">التالي</button>
            <?php
            } elseif (!isset($_SESSION['hosting'])) {
                // الخطوة 5: استضافة
            ?>
                <label class="lableQ" style="display: grid"> هل تحتاج استضافة ودومين؟ </lable>
                <div class="choose"><span>نعم</span><input class="optionQ" type="radio" name="hosting" value="yes"></div> 
                <div class="choose"><span>لا</span><input class="optionQ" type="radio" name="hosting" value="no"></div>
                <button class="buttonQ" type="submit">التالي</button>
            <?php
            } elseif (!isset($_SESSION['desing'])) {
                // الخطوة 6: التصميم
            ?>
                <label class="lableQ"  style="display: grid"> هل لديك تصميم جاهز؟ </lable>
                <div class="choose"><span>نعم</span><input class="optionQ" type="radio" name="desing" value="yes"></div> 
                <div class="choose"><span>لا</span><input class="optionQ" type="radio" name="desing" value="no"></div>                <button class="buttonQ" type="submit">التالي</button>
            <?php
            } else{
                // الخطوة 6: عرض التكلفة
                echo '<div class="result">إجمالي التكلفة التقديرية: <strong>' . $total . ' دولار</strong></div>';
                echo '<form method="POST">
                        <button class="buttonQ" type="submit" name="reset">إعادة الحساب</button>
                    </form>';
            }
            ?>
        </form>

        <?php
        // في حالة رغبة المستخدم في إعادة الحساب
        if (isset($_POST['reset'])) {
            session_destroy(); // تدمير الجلسة لإعادة البدء
            header("Location: follow.php"); // إعادة توجيه المستخدم إلى الصفحة الرئيسية
        }
        ?>
    </div>
    </div>


    <script>
        let target = document.getElementById('part');
        target.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
        target.focus();
    </script>

<?php
    include "includes/footer.php";

    ob_end_flush();
?>