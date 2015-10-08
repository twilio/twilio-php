=============
Reservations
=============

TaskRouter creates a Task Reservation subresource whenever a Task is assigned to a Worker. TaskRouter will provide the details of this Reservation Instance subresource in the Assignment Callback HTTP request it makes to your application server. You must POST **ReservationStatus=accepted** or **ReservationStatus=rejected** to this resource within the reservation timeout to claim or reject this task. 


Update a Reservation 
=======================

TO indicate that a Worker has accepted or rejected a Task, you can: 

.. code-block:: php

	require 'Services/Twilio.php';

	$accountSid = 'YOUR_ACCOUNT_SID';
	$authToken = 'YOUR_AUTH_TOKEN';
	$workspaceSid = 'YOUR_WORKSPACE_SID';
	$taskSid = 'YOUR_TASK_SID'; 

	// instantiate a Twilio TaskRouter Client 
	$taskrouterClient = new TaskRouter_Services_Twilio($accountSid, $authToken, $workspaceSid);
	
	// set reservation parameters
	$reservationStatus = 'accepted'; 

	// update the reservation status
	$taskrouterClient->workspace->tasks->get($taskSid)->reservations->get($reservationSid)->update('ReservationStatus', $reservationStatus); 