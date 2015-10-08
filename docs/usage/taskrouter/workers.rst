===========
Workers
===========

Workers represent an entity that is able to perform tasks, such as an agent working in a call center, or a salesperson handling leads.

Creating a Worker 
==============================

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);
	
	// set worker parameters 
	$friendlyName = 'Bob'; 
	$activitySid = 'YOUR_ACTIVITY_SID'; 
	$workerAttributes = '{"languages":"fr"}';  

	$worker = $taskrouterClient->workspace->workers->create(
		$friendlyName, 
		array(
			'Attributes' => $workerAttributes, 
			'ActivitySid' => $idleActivitySid
		)
	);

	// confirm worker created
	echo "Created Worker: ".$worker.sid;

Updating a Worker
==============================

This update changes the worker above to now be able to handle additional tasks, specfically, tasks that have a language attribute = "sv". 

.. code-block:: php

	$workerSid = 'YOUR_WORKER_SID';

	// set updated worker parameters 
	$updatedWorkerAttributes = '{"language": ["fr", "sv"]}'; 
	
	// update worker
	$taskrouterClient->workspace->workers->get($workerSid)->update(
		array(
			'Attributes' => $updatedWorkerAttributes
		)
	); 

	echo 'Updated Worker: '.$workerSid; 


Deleting a Worker
==============================

.. code-block:: php

	$workerSid = 'YOUR_WORKER_SID';

	$taskrouterClient->workspace->workers->delete($workerSid); 

	echo 'Deleted Worker: '.$workerSid; 


Get a List of all Workers
==============================

.. code-block:: php

	foreach($taskrouterClient->workspace->workers as $worker)
	{
		echo $worker->sid; 
	}

	