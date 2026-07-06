<?php

    $page_title = 'College school fees';

    include('header.php');

    $fail = '';

    if (isset($_GET['fail'])) {

        $fail = $_GET['fail'];
    }

?>


<p class="page-intro">
    Pick a term and academic session to view the college (student) school fees details.
</p>


<section class="panel form-card">

    <div class="panel-head">
        <h2>Required data</h2>
    </div>

    <div class="panel-body">

        <form action="school_fees_details_view.php" method="POST">

            <?php if ($fail !== ''): ?>
                <p class="form-feedback"><?php echo htmlspecialchars($fail); ?></p>
            <?php endif; ?>

            <label for="term">Term</label>
            <select name="term" id="term">
                <option value="first">first</option>
                <option value="second">second</option>
                <option value="third">third</option>
            </select>

            <label for="session">Academic session</label>
            <input type="text" name="session" id="session" placeholder="e.g. 2025/2026">
            <span id="session_error" class="form-feedback"></span>

            <button type="submit" name="submit" class="btn-purple" value="submit">View details</button>

        </form>

    </div>

</section>


<script>

    // live format hint for the academic session field.....

    (function(){

        var input = document.getElementById('session');
        var error = document.getElementById('session_error');
        var pattern = /^([0-9]{4})\/([0-9]{4})$/;

        input.addEventListener('keyup', function(){

            if (input.value !== '' && !pattern.test(input.value)) {

                error.textContent = 'format: 2025/2026';

            } else {

                error.textContent = '';
            }
        });

    })();

</script>


<?php

include('footer.php');

?>
