<?php

    ob_start();

    session_start();

    $pageTitle  = "متابعة الشكوي" ;
    $current_page = basename($_SERVER['PHP_SELF']);
    include "includes/func/function.php";
    include "includes/header.php";
    include "includes/nav.php";
    include "conect.php";

    $name   = $_SESSION['userName'];
    $code   = $_SESSION['ID'];


            $stFollow = $con->prepare("SELECT
                                             * 
                                        FROM 
                                            information 
                                        INNER JOIN 
                                            sections
                                        ON
                                            sections.ID = information.Section_Id
                                        WHERE ID_Complaints = '$code' AND P_Name = '$name'");
            $stFollow->execute();
            $follow = $stFollow->fetchAll();
            foreach($follow as $fol)

        ?>

            <section class="container mt-3 p-3 bg-dark text-light text-center">
                <h2 class= "p-3"> متابعة الشكوي </h2>
                <div class="row followP">
                    <div class="col-md-4">
                        <div>
                            <h4> الأسم  : </h4>
                                <?php
                                    echo $fol['P_Name'];
                                ?>
                        </div>
                        <br><hr>
                        <div>
                            <h4> العمر : </h4>
                                <?php
                                    echo $fol['P_Age'];
                                ?>
                        </div>
                        <br><hr>
                        <div>
                            <h4> رقم الهاتف : </h4>
                            <?php
                                echo $fol['P_PHone'];
                                ?>      
                        </div>
                    </div>
                    <div class= "col-md-4">
                        <div>
                            <h4> الفرع : </h4>
                                <?php
                                    echo $fol['Name'];
                                ?>
                        </div>
                        <br><hr>                   
                        <div>
                            <h4> تاريخ تقديم الشكوي  :</h4>
                                <?php
                                    echo $fol['Date'];
                                ?>
                                
                        </div>
                        <br><hr>
                        <div>
                            <h4> الحاله : </h4>
                                <?php
                                    if($fol['State'] === 0){
                                        echo 'شكوتك قيد المعالجة';
                                    }else{
                                        echo 'تم معالجة شكوتك';
                                    }
                                ?>
                        </div>
                    </div>
                </div>
            </section>

    <?php
        include "includes/footer.php";

        ob_end_flush();

    ?>
