.. _usage-taskrouter:

================================
Getting Started with TaskRouter
================================
Twilio TaskRouter enables you to manage a set of Workers, a set of Tasks, and the configuration that determines how the Tasks are matched and distributed to Workers. 

Creating a TaskRouter Client
==============================

It is necessary to first create a TaskRouter_Services_Twilio instance. You will need your Twilio account's Account Sid and Auth Token, which are available under your Twilio Account Dashboard.

.. code-block:: php

	require 'Services/Twilio.php';

	// set accountSid and authToken
	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';

	// set the workspaceSid
	$workspaceSid = 'YOUR_WORKSPACE_SID';

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);

If you do not have a workspace to specify, you can pass in **null** for the workspaceSid parameter as follows:

.. code-block:: php

	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, null);


You've now got a Twilio TaskRouter Client up! You can now do things like create a worker, update a task, or reconfigure your workspace amongst other things. 

