===========
Workflows
===========

Workflows control how tasks will be prioritized and routed into Queues, and how Tasks should escalate in priority or move across queues over time. Workflows are described in a simple JSON format and can be modified through the REST API or through the account portal.

Creating a Workflow
==============================

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);
	
	// set workflow parameters
	$friendlyName = 'Example Workflow';
	$configuration = '{"task_routing":{"default_filter":{"task_queue_sid":"YOUR_TASK_QUEUE_SID"}}}';
	$assignmentCallbackUrl = 'http://exampleCallbackUrl.org'; 
	$fallbackAssignmentCallbackUrl = 'http://exampleFallbackUrl.org';
	$taskReservationTimeout = 50;

	// create a Workflow
	$workflow = $taskrouterClient->workspace->workflows->create(
		$friendlyName,		
		$configuration, 	
		$assignmentCallbackUrl, 
		array(
			'FallbackAssignmentCallbackUrl' => $fallbackAssignmentCallbackUrl,
			'TaskReservationTimeout' => $taskReservationTimeout
		)
	);

	// confirm workflow created
	echo 'Created Workflow: '.$workflow->sid;

Updating a Workflow
==============================

This example updates the above workflow's configuration and task reservation timeout. 

.. code-block:: php

		$workflowSid = 'YOUR_WORKFLOW_SID'; 
		
		// updated workflow parameters 
		$updatedConfiguration = '{"task_routing":{"default_filter":{"task_queue_sid" : "YOUR_UPDATED_TASK_QUEUE_SID"}}}';
		$updatedFallbackAssignmentUrl = 'http://updatedFallbackAssignmentUrl.org';
		$updatedTaskReservationTimeout = 150; 

		// update workflow 
		$taskrouterClient->workspace->workflows->get($workflowSid)->update(
			array(
				'Configuration' => $updatedConfiguration, 
				'TaskReservationTimeout' => $updatedTaskReservationTimeout
			)
		);

		echo 'Updated Workflow: '.$workflowSid; 


Deleting a Workflow
==============================

.. code-block:: php

	$workflowSid = 'YOUR_WORKFLOW_SID'; 
	$taskrouterClient->workspace->workflows->delete($workflowSid); 
	echo 'Deleted Workflow: '.$workflowSid; 


Get a List of all Workflows
==============================

.. code-block:: php

	foreach($taskrouterClient->workspace->workflows as $workflow)
	{
		echo $workflow->sid; 
	}

	