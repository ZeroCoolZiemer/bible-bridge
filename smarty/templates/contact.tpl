<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <meta name="description" content="">
    {include file="bootstrap-head.tpl"}
    <link href="/css/footer.css" rel="stylesheet">
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
</head>

<body class="body-text">
    {include file="menu.tpl"}
    <div class="container mt-4 px-5">
        <h1 class="text-center mb-4">Contact Us</h1>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <form class="bg-light border rounded-3 p-4 shadow" action="/contact" method="POST" id="contactForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <select class="form-select" id="subject" name="subject">
                            <option value="" selected disabled>Select a subject</option>
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Bible Software Purchase">Bible Software Purchase</option>
                            <option value="Technical Support">Technical Support</option>
                            <option value="Feature Request">Feature Request</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="captcha" class="form-label">SOLVE: What is the sixth word in <a class="text-decoration-none" href="{$website}bible/revelation/22/1" target="_blank">Revelation 22:1</a>?</label>
                        <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Enter the answer" autocomplete="off">
                    </div>
                    <div class="text-center mt-3">
                        <button id="submitButton" type="button" class="btn btn-sm btn-dark" onclick="submitForm()">Submit</button>
                    </div>
                </form>
                <div class="d-flex justify-content-center">
                    <div class="alert alert-success mt-3" id="successMessage" style="display:none;"></div>
                    <div class="alert alert-danger mt-3" id="errorMessage" style="display:none;"></div>
                </div>
            </div>
        </div>
    </div>
    {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{$website}/js/contact.js"></script>
    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}
</body>

</html>