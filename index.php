<?php
// Database connection
$conn = mysqli_connect('localhost','root','','contact_db') or die('connection failed');

if(isset($_POST['submit'])){
    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $date   = mysqli_real_escape_string($conn, $_POST['date']);
    $doctor = mysqli_real_escape_string($conn, $_POST['doctor']);
    $slot   = mysqli_real_escape_string($conn, $_POST['slot']);

    // Check if slot is already booked for this doctor/date
    $check_query = "SELECT COUNT(*) AS cnt FROM contact_form WHERE doctor='$doctor' AND date='$date' AND slot='$slot'";
    $check = mysqli_query($conn, $check_query) or die('Check query failed');
    $row = mysqli_fetch_assoc($check);

    if($row['cnt'] > 0) {
        $message[] = "Sorry, Dr. $doctor already has the $slot slot booked on $date.";
    } else {
        $insert_query = "INSERT INTO contact_form(name, email, number, date, doctor, slot) VALUES('$name','$email','$number','$date','$doctor','$slot')";
        $insert = mysqli_query($conn, $insert_query) or die('Insert query failed');

        if($insert){
            $message[] = 'Appointment made successfully!';
        } else {
            $message[] = 'Appointment failed. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VCare - Your Health, Our Priority</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
    <a href="#" class="logo"><i class="fas fa-heartbeat"></i><strong>VCare</strong> Medical</a>
    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#services">services</a>
        <a href="#doctors">doctors</a>
        <a href="#appointment">appointment</a>
        <a href="#review">review</a>
        <a href="#blogs">blogs</a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<!-- appointmenting section starts -->
<section class="appointment" id="appointment">
    <h1 class="heading"><span>appointment</span> now</h1>
    <div class="row">
        <div class="image">
            <img src="image/appointment-img.svg" alt="">
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php if(isset($message)): ?>
                <?php foreach($message as $msg): ?>
                    <p class="message"><?php echo $msg; ?></p>
                <?php endforeach; ?>
            <?php endif; ?>

            <h3>make appointment</h3>
            <input type="text" name="name" placeholder="Your Name" class="box" required>
            <input type="number" name="number" placeholder="Your Number" class="box" required>
            <input type="email" name="email" placeholder="Your Email" class="box" required>
            <input type="date" name="date" class="box" required>

            <select name="doctor" class="box" required>
                <option value="" disabled selected>Select a doctor</option>
                <option value="Dr. Annie">Dr. Annie - Cardiologist</option>
                <option value="Dr. Harry">Dr. Harry - Neurologist</option>
                <option value="Dr. Sophia">Dr. Sophia - Pulmonologist</option>
                <option value="Dr. Olivia">Dr. Olivia - Dermatologist</option>
                <option value="Dr. Jack">Dr. Jack - Oncologist</option>
                <option value="Dr. Charles">Dr. Charles - Nephrologist</option>
                <option value="Dr. Amelia">Dr. Amelia - Pulmonologist</option>
                <option value="Dr. Edward">Dr. Edward - Endocrinologist</option>
                <option value="Dr. Alphonse">Dr. Alphonse - Gynecologist</option>
            </select>

            <select name="slot" class="box" required>
                <option value="" disabled selected>Select a time slot</option>
                <option value="09:00-10:00">09:00 – 10:00</option>
                <option value="10:00-11:00">10:00 – 11:00</option>
                <option value="11:00-12:00">11:00 – 12:00</option>
                <option value="14:00-15:00">14:00 – 15:00</option>
                <option value="15:00-16:00">15:00 – 16:00</option>
            </select>

            <input type="submit" name="submit" value="Appointment Now" class="btn">
        </form>
    </div>
</section>
<!-- appointmenting section ends -->

<!-- footer and other sections unchanged -->
<script src="js/script.js"></script>
</body>
</html>
