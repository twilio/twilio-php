===========
Workspaces
===========

A Workspace is a container for your Tasks, Workers, TaskQueues, Workflows and Activities. Each of these items exists within a single Workspace and will not be shared across Workspaces. 

Creating a Workspace
==============================

.. code-block:: php

	require 'Services/Twilio.php';

	// set account parameters 
	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, null);
	
	// create a workspace
	$workspace = $taskrouterClient->createWorkspace(
		$accountSid,		// AccountSid
		$authToken, 		// AuthToken
		$friendlyName 		// name for workspace
	);

	// confirm workspace created
	echo 'Created Workspace: '.$workspace->sid; 

Updating a Workspace
==============================

This update below alters the workspace to a new FriendlyName and EventCallbackUrl.

.. code-block:: php

		$workspaceSid = 'YOUR_WORKSPACE_SID';

		$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);

		// updated workspace parameters
		$updatedFriendlyName = 'My Updated Workspace';
		$updatedEventCallbackUrl = 'http://updatedEventCallbackUrl.org'; 

		// update workspace
		$taskrouterClient->workspace->update(
			array(
				'FriendlyName' => $updatedFriendlyName,
				'EventCallbackUrl' => $updatedEventCallbackUrl
			)
		);

		echo 'Updated Workspace: '.$workspaceSid; 


Deleting a Workspace
==============================

.. code-block:: php

	$workspaceSid = 'YOUR_WORKSPACE_SID';

	$taskrouterClient->workspaces->delete($workspaceSid); 

	echo 'Deleted Workspace: '.$workspaceSid; 


Get a List of all Workspaces
==============================

.. code-block:: php

	foreach($taskrouterClient->workspaces as $workspace)
	{
		echo $workspace->sid; 
	}
