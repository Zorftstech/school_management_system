<?php

    $page_title = 'Register principal';

    include('action_php/header.php');

    $error = '';

    if (isset($_GET['process'])) {

        $error = $_GET['process'];
    }

?>


<p class="page-intro">
    Register a new principal for one of the schools. They will receive a verification
    email and must confirm it before they can log in to their portal.
</p>


<section class="panel form-card">

    <div class="panel-head">
        <h2>Principal details</h2>
    </div>

    <div class="panel-body">

        <form action="action_php/principal_registration_action.php" method="POST">

            <?php if ($error !== ''): ?>
                <p class="form-feedback"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <label for="email">Email address</label>
            <input type="email" id="email" placeholder="name@school.edu.ng" required name="email">

            <label for="user">Username</label>
            <input type="text" id="user" placeholder="Choose a username" required name="user">

            <label for="pwd">Password</label>
            <input type="password" id="pwd" placeholder="Set a temporary password" required name="password">

            <button type="submit" name="submit" class="btn-purple" value="submit">Register principal</button>

        </form>

        <p class="form-note">
            Verification email not delivered? <a href="resend_email_varify.php">Resend it</a>
            &nbsp;·&nbsp; <a href="principal_details.php">View all principals</a>
        </p>

    </div>

</section>


<?php

include('action_php/footer.php');

?>
