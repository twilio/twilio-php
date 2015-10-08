===========
Activities
===========

Activities describe the current status of your Workers, which determines whether they are eligible to receive task assignments. Workers are always set to a single Activity. 

Creating an Activity
==============================

You can create a new activity by specifying its friendly name and availability.

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);
	
	// set activity parameters
	$friendlyName = 'New Activity'; 
	$activityAvailability = 'false';

	// create an activity
	$activity = $taskrouterClient->workspace->activities->create(
		$friendlyName, 
		$activityAvailability
	);

	// confirm activity created
	echo "Created Activity: ".$activity->sid;

Updating an Activity 
==============================

Updates to an activity are restricted to only the FriendlyName 

.. code-block:: php

	$activitySid = 'YOUR_ACTIVITY_SID'; 

	// updated activity parameters
	$updatedActivityFriendlyName = "Updated Activity Name";

	// updated activity
	$taskrouterClient->workspace->activities->get($activitySid)->update(
		array(
			'FriendlyName' => $updatedActivityFriendlyName
		)
	); 

	echo 'Updated Activity: '.$activitySid; 

Deleting an Activity
==============================

Deleting an activity is just as easy as creating an activity. Simple make a call to delete and pass in the sid of the activity. 

.. code-block:: php

	$activitySid = 'YOUR_ACTIVITY_SID';

	$taskrouterClient->workspace->activities->delete($activitySid); 

	echo 'Deleted Activity: '.$activitySid; 

Get a List of all Activities
==============================

You can also loop through the list of all activities in a workspace.

.. code-block:: php

	foreach($taskrouterClient->workspace->activities as $activity)
	{
		echo $activity->sid; 
	}

	