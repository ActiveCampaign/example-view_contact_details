ActiveCampaign Custom API Script: View a contact's details including list subscriptions, custom field data, recent actions, and campaign history.

This script is intended to get you going with our API by providing an interface to view contact data. You are free to customize the script to your liking.

## Requirements

1. [Our PHP API library](https://github.com/ActiveCampaign/activecampaign-api-php)
2. A web server where you can run PHP code

## Installation and Usage

You can install **example-view_contact_details** by downloading (or cloning) the source.

Input your ActiveCampaign URL and API Key at the top of the script. Example below:

<pre>
$api_url = "https://ACCOUNT.api-us1.com";
$api_key = "4f3c6d12f0.....00ca273778dc893";
</pre>

Also make sure the path to the PHP library is correct:

<pre>
require_once("../../activecampaign-api-php/includes/ActiveCampaign.class.php");
</pre>

### Quick Overview

Load the URL with the contact hash as a parameter (you can obtain the hash using the `contact_view` API method):

`http://mysite.com/view_contact_details/index.php?hash=[HASH]`

## Documentation and Links

* [ActiveCampaign API documentation](http://www.activecampaign.com/api/)

## Reporting Issues

We'd love to help if you have questions or problems. Report issues using the [Github Issue Tracker](issues) or email help@activecampaign.com.