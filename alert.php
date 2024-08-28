<script>
      <?php 
            if(isset($_SESSION["login_success"])){
                

            
            ?>
            Swal.fire({
                title: "สำเร็จ",
                text: "เข้าสู่ระบบสำเร็จ",
                icon: "success"
            });
            <?php 
            }
            unset($_SESSION["login_success"]);
            ?>



            <?php 
            if(isset($_SESSION["login_error"])){
                

            
            ?>
            Swal.fire({
                title: "ไม่สำเร็จ",
                text: "ไม่สำเร็จ",
                icon: "error"
            });
            <?php 
            }
            unset($_SESSION["login_error"]);
            ?>


            <?php 
            if(isset($_SESSION["save_success"])){
                
            ?>
            Swal.fire({
                title: "บันทึกสำเร็จ",
                text: "บันทึกข้อมูลสำเร็จ",
                icon: "success"
            });
            <?php 
            }
            unset($_SESSION["save_success"]);
            ?>
</script>