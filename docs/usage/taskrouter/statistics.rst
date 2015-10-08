===========
Statistics 
===========

TaskRouter provides real time and historical statistics for each Workspace subresource. Real time statistics allow you to check the current state of the system (tasks, workers, queues). Historical statistics allow you to analyze the efficiency of your Workflows, TaskQueues and Workers.


Workspace Statistics 
=====================

You can get workspace statistics by doing the following: 

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);

	// fetch workspace statistics
	$stats = taskrouterClient->getWorkspaceStatistics(array('Minutes' => 60));

	// confirm stats 
	echo $stats->account_sid; 


Workflow Statistics 
=====================

You can get workflow statistics by doing the following: 

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	$workflowSid = 'YOUR_WORKFLOW_SID'; 

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);

	// fetch workspace statistics
	$stats = taskrouterClient->getWorkflowStatistics($workflowSid, array('Minutes' => 60));

	// confirm stats 
	echo $stats->account_sid; 


Worker Statistics 
=====================

You can get worker statistics by doing the following: 

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	$workerSid = 'YOUR_WORKER_SID'; 

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);

	// fetch workspace statistics
	$stats = $taskrouterClient->getWorkerStatistics($workerSid, array('Minutes' => 60));

	// confirm stats 
	echo $stats->account_sid; 


TaskQueue Statistics 
=====================

You can get task queue statistics by doing the following: 

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	$taskQueueSid = 'YOUR_TASK_QUEUE_SID'; 

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);

	// fetch workspace statistics
	$stats = $taskrouterClient->getTaskQueueStatistics($taskQueueSid, array('Minutes' => 60));

	// confirm stats 
	echo $stats->account_sid; 

