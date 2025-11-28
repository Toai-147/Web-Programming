<h2>Student Forum</h2>
<p>Welcome to the Student Forum</p>

<?php if (isset($_GET['contact']) && $_GET['contact'] === 'success'): ?>
    <div class="errors" style="border-color: green; background-color: lightgreen; color: green;">
        <p>Your message has been sent successfully!</p>
    </div>
<?php endif; ?>

<h3>Contact Admin</h3>
<form action="addcontact.php" method="post">
    <label for="contacttext">Your message:</label>
    <textarea name="contacttext" id="contacttext" rows="5" cols="40" required></textarea>
    <input type="submit" value="Send Message">
</form>