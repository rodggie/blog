<?php
    require 'partials/header.php';
?>
    <section class="form__section add__post">
        <div class="container form__section-container">
            <h2>Edit User</h2>
            <div class="alert__message error">
                <p>The error message goes here.</p>
            </div>
            <form action="" enctype="multipart/form-data">
                <input type="text" placeholder="First Name">
                <input type="text" placeholder="Last Name">
                <label for="user_role">User Role</label>
                <select id="user_role">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
                <button type="submit" class="btn">Edit</button>
            </form>
        </div>
    </section>

<?php
    require '../partials/footer.php';
?>