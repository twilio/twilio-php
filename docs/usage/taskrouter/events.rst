===========
Events
===========

TaskRouter logs Events for each state change in the Workspace for the purpose of historical reporting and auditing. TaskRouter will also make an HTTP request containing the Event details to the Workspace's EventCallbackURL each time one these Events takes place. 

Get an Event 
=====================

You can get details on a specific event by doing the following: 

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	$eventSid = 'YOUR_EVENT_SID'; 

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);

	// fetch workspace statistics
	$event = taskrouterClient->workspace->events->get($eventSid); 


Get a List of all Events
==============================

You can also loop through the list of all events in a workspace.

.. code-block:: php

	foreach($taskrouterClient->workspace->events as $event)
	{
		echo $event->sid; 
	}