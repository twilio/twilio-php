===========
Task Queues
===========

TaskQueues are the resource you use to categorize Tasks and describe which Workers are eligible to handle those Tasks. As your Workflows process Tasks, those Tasks will pass through one or more TaskQueues until the Task is assigned and accepted by an eligible Worker.

Creating a Task Queue
==============================

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);
	
	// set taskQ parameters
	$friendlyName = "FrenchQ"; 
	$assignmentActivitySid = 'YOUR_ASSIGNMENT_ACTIVITY_SID';
	$reservationActivitySid = 'YOUR_RESERVATION_ACTIVITY_SID';
	$targetWorkers = 'languages HAS "fr"'; 
	
	$taskQ = $taskrouterClient->workspace->task_queues->create(
		$friendlyName, 
		$assignmentActivitySid, 
		$reservationActivitySid, 
		array(
			"TargetWorkers" => $targetWorkers
		)
	); 
	
	// confirm task queue created
	echo 'Created TaskQ: '.$taskQ->sid; 

Updating a Task Queue
==============================

In this example, we update the above task queue to now accept tasks which have a language attribute of french or swedish, or both. 


.. code-block:: php

	$taskQSid = 'YOUR_TASK_QUEUE_SID'; 

	// updated taskQ parameters
	$updatedFriendlyName = "French and Swedish Q"; 
	$updatedTargetWorkers = 'languages HAS "fr" and languages has "sv"'; 

	//update taskQ
	$taskrouterClient->workspace->task_queues->get($taskQSid)->update(
		array(
			'FriendlyName'=> $updatedFriendlyName, 
			'TargetWorkers'=> $updatedTargetWorkers
		)
	);
	
	echo 'Updated Task Queue: '.$taskQSid;


Deleting a Task Queue
==============================

.. code-block:: php

	$taskQSid = 'YOUR_TASK_QUEUE_SID';

	$taskrouterClient->workspace->task_queues->delete($taskQSid); 

	echo 'Deleted Task Queue: '.$taskQSid; 


Get a List of all Task Queues
==============================

.. code-block:: php

	foreach($taskrouterClient->workspace->task_queues as $taskQ)
	{
		echo $taskQ->sid; 
	}

	