===========
Tasks
===========

A Task instance resource represents a single item of work waiting to be processed. Tasks can represent whatever type of work is important for your team. Twilio applications can create tasks from phone calls or SMS messages. 

Creating a Task
==============================

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);
	
	// set task parameters
	$workflowSid = 'YOUR_WORKFLOW_SID'; 
	$taskAttributes = '{"selected_language": "fr"}';
	$prioity = 10; 
	$timeout = 100;  

	// create task
	$task = $taskrouterClient->workspace->tasks->create(
		$taskAttributes, 
		$workflowSid, 
		array(
			'Priority' => $priority, 
			'Timeout' => $timeout
		)
	); 
	
	// confirm task created
	echo "Created Task: ".$task->sid; 

Updating a Task
==============================

Here, we modify the above created task to have an updated priority of 20 and contains Swedish instead of French. 

.. code-block:: php

	$taskSid = 'YOUR_TASK_SID'; 

	// update task parameters
	$updatedTaskAttributes = '{"languages":"sv"}';
	$updatedPriority = 20; 

	// update task 
	$taskrouterClient->workspace->tasks->get($taskSid)->update(
		array(
		'Attributes'=> $updatedTaskAttributes, 
		'Priority'=> $updatedPriority
		)
	); 
	
	echo 'Updated Task: '.$taskSid;


Deleting a Task
==============================

.. code-block:: php

	$taskSid = 'YOUR_TASK_SID';

	$taskrouterClient->workspace->tasks->delete($taskSid); 

	echo 'Deleted Task: '.$taskSid; 


Get a List of all Tasks
==============================

.. code-block:: php

	foreach($taskrouterClient->workspace->tasks as $task)
	{
		echo $task->sid; 
	}

	