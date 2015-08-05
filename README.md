# PHP CLIPS API Client

## Requirements
* PHP 5.3.10+
* cURL extension
* JSON extension
* Testing
  * PHPUnit 4.7.7 or higher

## SSL Connection Problems
If you run into a problem where cURL cannot connect to the API, you may need to
specify a specific .pem file. For your convenience, we've included the one used
on our server.

To see if this is your problem, run `curl https://clips.byu.edu`. You will get
the following error if you need to specify a .pem file:

"curl: (60) SSL certificate problem: unable to get local
issuer certificate"

Run `curl https://clips.byu.edu -cacert digicert.pem`, and you shouldn't see the
error this time.

To get this to work with the PHP script, use the environment variable
`CURL_CA_BUNDLE` and specify the certificate's location. For example:

`CURL_CA_BUNDLE=/path/to/digicert.pem php my-script.php`

## Running Tests

Note that tests currently require a valid API key, not included in this
repository.

`CLIPS_API_KEY=your_test_key phpunit tests`
