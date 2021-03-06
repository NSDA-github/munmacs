<html>

<head>
    <link rel="stylesheet" href="/css/adminlogin.css" />
</head>

<body>
    <form class="form-signin" action="/api/registeradmin" method="POST">
        <div class="form-group">
            <h1 class="h3 mb-3 font-weight-normal">Admin Registration</h1>
            <input class="form-control" type="text" id="username" name="username" placeholder="Username" required />
            <input class="form-control" type="password" id="newpassword" name="password" placeholder="Password" required />
            <select class="custom-select" name="level" id="level" required>
                <option value="" disabled selected>Access Level</option>
                <option value="3">Full Access</option>
                <option value="2">Data Export</option>
                <option value="1">View Only</option>
            </select>

            <input class="form-control" type="password" id="adminpassword" name="adminpassword" placeholder="Admin Password" required />
            <button class="btn btn-lg btn-primary btn-block" type="submit">
                Register
            </button>
        </div>
    </form>
</body>

</html>