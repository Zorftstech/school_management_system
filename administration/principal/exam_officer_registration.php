<?php

    $page_title = 'Register exam officer';

    include('header.php');

    $feedback = '';

    if (isset($_GET['process'])) {

        $feedback = $_GET['process'];
    }

    if (isset($_GET['result'])) {

        $feedback = $_GET['result'];
    }

?>


<p class="page-intro">
    Register a new exam officer. They will receive a verification code by email and must
    confirm it before they can log in to their portal.
</p>


<section class="panel form-card">

    <div class="panel-head">
        <h2>Exam officer details</h2>
    </div>

    <div class="panel-body">

        <form action="action_php/exam_officer_registration_action.php" method="POST">

            <?php if ($feedback !== ''): ?>
                <p class="form-feedback"><?php echo htmlspecialchars($feedback); ?></p>
            <?php endif; ?>

            <label for="email">Email address</label>
            <input type="email" id="email" placeholder="name@school.edu.ng" required name="email">

            <label for="user">Username</label>
            <input type="text" id="user" placeholder="Choose a username" required name="user">

            <label for="pwd">Password</label>
            <input type="password" id="pwd" placeholder="Set a temporary password" required name="password">

            <button type="submit" name="submit" class="btn-purple" value="submit">Register exam officer</button>

        </form>

        <p class="form-note">
            Verification email not delivered? <a href="exam_officer_resend_email.php">Resend it</a>
            &nbsp;·&nbsp; <a href="exam_officer_detail.php">View all</a>
        </p>

    </div>

</section>


<?php

include('footer.php');

?>
