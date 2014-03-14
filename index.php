<?php

	$api_url = "";
	$api_key = "";

	define("ACTIVECAMPAIGN_URL", $api_url);
	define("ACTIVECAMPAIGN_API_KEY", $api_key);

	require_once("../../activecampaign-api-php/includes/ActiveCampaign.class.php");
	$ac = new ActiveCampaign(ACTIVECAMPAIGN_URL, ACTIVECAMPAIGN_API_KEY);

	function dbg($var, $continue = 0, $element = "pre") {
	  echo "<" . $element . ">";
	  echo "Vartype: " . gettype($var) . "\n";
	  if ( is_array($var) ) echo "Elements: " . count($var) . "\n\n";
	  elseif ( is_string($var) ) echo "Length: " . strlen($var) . "\n\n";
	  print_r($var);
	  echo "</" . $element . ">";
		if (!$continue) exit();
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		header("Location: " . $_SERVER["SCRIPT_FILENAME"] . $_SERVER["REQUEST_URI"]);

	}
	else {

		if (!(int)$ac->credentials_test()) {
			print_r("Invalid credentials (URL or API Key).");
			exit();
		}

		if (!isset($_GET["hash"])) {
			echo "No hash provided.";
			exit();
		}

		$hash = $_GET["hash"];

		if (!$hash) {
			echo "No hash provided.";
			exit();
		}

		$contact = $ac->api("contact/view?hash={$hash}");

	}

//dbg($contact);

?>

<style type="text/css">

	body {
		font-family: Arial;
		font-size: 12px;
		margin: 30px;
	}

	h3 {
		margin-top: 30px;
	}

</style>

<form method="post">

	<input type="hidden" name="hash" value="<?php echo $hash; ?>" />

	<?php

		echo "<h2>" . $contact->name . " (" . $contact->email . ")</h2>";

		echo "<h3>Lists</h3>";

		foreach ($contact->lists as $list) {
			$checked = ($list->status == 1) ? "checked='checked'" : "";
			echo "<p><input type='checkbox' name='lists[" . $list->id . "]' id='list_" . $list->id . "' " . $checked . " /> " . $list->listname . "</p>";
		}

		echo "<h3>Custom Fields</h3>";

		foreach ($contact->fields as $field) {
			$list_assoc = ((int)$field->relid) ? "List ID " . $field->relid : "Global";
			echo "<p><b>" . $field->title . " (" . $list_assoc . ")</b>: " . $field->val . "</p>";
		}

		echo "<h3>Recent Actions</h3>";

		foreach ($contact->actions as $action) {
			echo "<p>" . $action->text . " on " . date("m/d/Y H:i", strtotime($action->tstamp)) . "</p>";
		}

		echo "<h3>Campaign History</h3>";

		foreach ($contact->campaign_history as $campaign) {
			echo "<p>" . $campaign->campaignname . " (Sent at " . date("m/d/Y H:i", strtotime($campaign->sdate)) . ")</p>";
		}

	?>

</form>