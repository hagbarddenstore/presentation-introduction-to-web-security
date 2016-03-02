<!DOCTYPE html>
<html>
    <head>
        <title>2.1 - Reflected XSS</title>
    </head>
    <body>
        <p><a href="/">Back to index page</a></p>
        <form action="index.php" method="get">
            <input type="text" name="q" value="<?php echo $_GET['q']; ?>">
            <input type="submit" value="Submit">
        </form>
        <p>This test won't work in Chrome and Safari because the XSS Auditor
        will block XSS attempts. To be able to run in Chrome and Safari, the
        XSS auditor needs to be disabled.</p>
        <p>Disable the auditor in Chrome by appending the
        <code>--disable-web-security</code> flag when executing the binary.</p>
        <p>Windows: <code>"C:\Program Files (x86)\Google\Chrome\Application\chrome.exe" --disable-xss-auditor</code></p>
        <p>Mac OS X: <code>/Applications/Google\ Chrome.app/Contents/MacOS/Google\ Chrome --disable-xss-auditor</code></p>
        <p>Linux: <code>/opt/google/chrome/google-chrome --disable-xss-auditor</code></p>
        <p>Disable the auditor in Safary by running:
        <code>defaults write com.apple.Safari "com.apple.Safari.ContentPageGroupIdentifier.WebKit2XSSAuditorEnabled" -bool FALSE</code></p>
        <p>Be sure to run the command again but replace FALSE with TRUE to
        enable the XSS Auditor when you're done testing.</p>
    </body>
</html>