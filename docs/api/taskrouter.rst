.. _api-taskrouter:

######################
Twilio TaskRouter API 
######################

**************
List Resources
**************

.. phpautoclass:: Services_Twilio_ListResource
    :filename: ../Services/Twilio/ListResource.php
    :members:

All of the below classes inherit from the :php:class:`ListResource
<Services_Twilio_ListResource>`.


Workspaces
====================
.. php:class:: Services_Twilio_Rest_TaskRouter_Workspaces

   For more information, see the Workspaces API Resource https://www.twilio.com/docs/taskrouter/workspaces

   .. php:method:: create($friendlyName, array $params = array())

      Make a workspace

      :param string $friendlyName: String representing a user-friendly name for the Workspace
      :param array $params: An array of optional parameters for this call

      The **$params** array can contain the following keys:

      *EventCallbackUrl*
		If provided, the Workspace will publish events to this URL. You can use this to gather data for reporting.

      *Template*
		One of the available template names. Will pre-configure this Workspace with the Workflow and Activities specified in the template. “NONE” will create a Workspace with a set of default activities and nothing else. "FIFO" will configure TaskRouter with a set of default activities and a single task queue for first-in, first-out distribution, useful if you want to see a simple TaskRouter configuration when getting started.


Workflows
====================
.. php:class:: Services_Twilio_Rest_TaskRouter_Workflows

   For more information, see the Workflows API Resource https://www.twilio.com/docs/taskrouter/workflows

   .. php:method:: create($friendlyName, $configuration, $assignmentCallbackUrl, array $params = array())

      Make a workflow

      :param string $friendlyName: String representing a user-friendly name for the Workflow
      :param string $configuration: JSON document configuring the rules for this Workflow
      :param string $assignmentCallbackUrl: A valid URL for the application that will process task assignment events 
      :param array $params: An array of optional parameters for this call

      The **$params** array **must** contain a TaskReservationTimeout, but FallbackAssignmentCallbackUrl is **optional**. 

      *FallbackAssignmentCallbackUrl*
		If the request to the AssignmentCallbackUrl fails, the assignment callback will be made to this URL

      *TaskReservationTimeout*
		An integer value controlling how long in seconds TaskRouter will wait for a confirmation response from your application after assigning a Task to a worker
 

Workers
====================
.. php:class:: Services_Twilio_Rest_TaskRouter_Workers

   For more information, see the Workers API Resource https://www.twilio.com/docs/taskrouter/workers 

   .. php:method:: create($friendlyName, array $params = array())

      Make a worker

      :param string $friendlyName: String representing a user-friendly name for the Worker
      :param array $params: An array of optional parameters for this call

      The **$params** array can contain the following keys:

      *ActivitySid*
		A valid Activity describing the worker's initial state

      *Attributes*
		JSON object describing this worker


TaskQueues
====================
.. php:class:: Services_Twilio_Rest_TaskRouter_TaskQueues

   For more information, see the TaskQueues API Resource https://www.twilio.com/docs/taskrouter/taskqueues

   .. php:method:: create($friendlyName, $assignmentActivitySid, $reservationActivitySid, array $params = array())

      Make a task queue

      :param string $friendlyName: String representing a user-friendly name for the Task Queue 
      :param string $assignmentActivitySid: The activity to assign a worker when they accept a Task from this TaskQueue; defaults to 'Busy'
      :param string $reservationActivitySid: The Activity to assign a Worker when they are reserved for a Task from this TaskQueue; defaults to 'Reserved'
      :param array $params: An array of optional parameters for this call

      The **$params** array can contain the following keys:

      *TargetWorkers*
		A string describing the Worker selection criteria for any Tasks that enter this TaskQueue

      *MaxReservedWorkers*
		The maximum amount of workers to create reservations for the assignment of a task while in this queue; default = 1, max = 50 


Tasks
====================
.. php:class:: Services_Twilio_Rest_TaskRouter_Tasks

   For more information, see the Tasks API Resource https://www.twilio.com/docs/taskrouter/tasks

   .. php:method:: create($attributes, $workflowSid, array $params = array())

      Make a task

      :param string $attributes: The user-defined JSON string describing the custom attributes of this work
      :param string $workflowSid: The ID of the Workflow responsible for routing this Task
      :param array $params: An array of optional parameters for this call

      The **$params** array can contain the following keys:

      *Timeout*
		The amount of time in seconds the task is allowed to live; default = 24 hours 

      *Priority*
		Override priority for the Task


Activities 
========================

.. php:class:: Services_Twilio_Rest_TaskRouter_Activities

   For more information, see the Activities API Resource https://www.twilio.com/docs/taskrouter/activities documentation

   .. php:method:: create($friendlyName, $available)

      Make an activity 

      :param string $friendlyName: String representing a user-friendly name for the Activity
      :param string $available: Boolean value indicating whether the worker should be eligible to receive a Task when they occupy this Activity


Events
========================

.. php:class:: Services_Twilio_Rest_TaskRouter_Events

	For more information, see the Events API Resource https://www.twilio.com/docs/taskrouter/events documentation


Reservations
=======================

.. php:class:: Services_Twilio_Rest_TaskRouter_Reservations

	For more information, see the Task Reservation Instance Subresource section on https://www.twilio.com/docs/taskrouter/tasks documentation


Workers Statistics
========================

.. php:class:: Services_Twilio_Rest_TaskRouter_WorkersStatistics

	For more information, see the Worker Statistics API Resource https://www.twilio.com/docs/taskrouter/worker-statistics documentation


TaskQueue Statistics 
======================

.. php:class:: Services_Twilio_Rest_TaskRouter_TaskQueuesStatistics

	For more information, see the TaskQueue Statistics API Resource https://www.twilio.com/docs/taskrouter/taskqueue-statistics documentation

********************
Instance Resources
********************

.. phpautoclass:: Services_Twilio_InstanceResource
    :filename: ../Services/Twilio/InstanceResource.php
    :members:

Below you will find a list of objects created by interacting with the Twilio
API, and the methods and properties that can be called on them. These are
derived from the :php:class:`ListResource <Services_Twilio_ListResource>` and
:php:class:`InstanceResource <Services_Twilio_InstanceResource>` above.


Workspace
====================

.. php:class:: Services_Twilio_Rest_TaskRouter_Workspace

	.. php:attr:: sid

		The unique ID of the Workspace

   	.. php:attr:: account_sid

   		The ID of the account that owns this Workflow

	.. php:attr:: friendly_name

		Human readable description of this workspace (for example “Sales Call Center” or “Customer Support Team”)

	.. php:attr:: default_activity_sid

		The ID of the Activity that will be used when new Workers are created in this Workspace.

	.. php:attr:: default_activity_name

		The human readable name of the default activity. Read only.

	.. php:attr:: timeout_activity_sid

		The ID of the Activity that will be assigned to a Worker when a Task reservation times out without a response.

	.. php:attr:: timeout_activity_name

		The human readable name of the timeout activity. Read only.

	.. php:attr:: event_callback_url

		An optional URL where the Workspace will publish events. You can use this to gather data for reporting. See Workspace Events for more information. Optional.
	
	.. php:attr:: date_created

		The time the Workspace was created, given as GMT in ISO 8601 format.
	
	.. php:attr:: date_updated

		The time the Workspace was last updated, given as GMT in ISO 8601 format.


Workflow
================

.. php:class:: Services_Twilio_Rest_TaskRouter_Workflow

	.. php:attr:: sid

		The unique ID of the Workflow

   	.. php:attr:: account_sid

   		The ID of the account that owns this Workflow

	.. php:attr:: workspace_sid

   		The ID of the Workspace that contains this Workflow

	.. php:attr:: friendly_name

		Human readable description of this Workflow (for example “Customer Support” or “2014 Election Campaign”)

	.. php:attr:: assignment_callback_url

		The URL that will be called whenever a task managed by this Workflow is assigned to a Worker. 

	.. php:attr:: fallback_assignment_callback_url

		If the request to the AssignmentCallbackUrl fails, the assignment callback will be made to this URL.

	.. php:attr:: configuration

		JSON document configuring the rules for this Workflow. See Configuring Workflows for more information.

	.. php:attr:: task_reservation_timeout

		Determines how long TaskRouter will wait for a confirmation response from your application after assigning a Task to a worker. Defaults to 120 seconds.

	.. php:attr:: date_created

		The date this workflow was created. 
	
	.. php:attr:: date_updated

		The date this workflow was updated. 

Worker
================

.. php:class:: Services_Twilio_Rest_TaskRouter_Worker

	.. php:attr:: friendly_name

		Filter by a worker’s friendly name

   	.. php:attr:: task_queue_sid

		Filter by workers that are eligible for a TaskQueue by SID

	.. php:attr:: task_queue_name

		Filter by workers that are eligible for a TaskQueue by Friendly Name

	.. php:attr:: activity_sid

		Filter by workers that are in a particular Activity by SID

	.. php:attr:: activity_name

		Filter by workers that are in a particular Activity by Friendly Name

	.. php:attr:: available

		Filter by workers that are available or unavailable. (Note: This can be ‘true’, ‘1’’ or ‘yes’ to indicate a true value. All other values will represent false)

	.. php:attr:: target_workers_expression

		Filter by workers that would match an expression on a TaskQueue. This is helpful for debugging which workers would match a potential queue.


TaskQueue
================

.. php:class:: Services_Twilio_Rest_TaskRouter_TaskQueue

	.. php:attr:: sid

		The unique ID of the TaskQueue

   	.. php:attr:: account_sid

		The ID of the Account that owns this TaskQueue

	.. php:attr:: workspace_sid

		The ID of the Workspace that owns this TaskQueue

	.. php:attr:: friendly_name

		Human readable description of the TaskQueue (for example “Customer Support” or “Sales”)

	.. php:attr:: target_workers

		The worker selection expressions associated with this TaskQueue.

	.. php:attr:: reservation_activity_sid

		The Activity to assign a Worker when they are reserved for a Task from this TaskQueue. Defaults to 'Reserved for Task'

	.. php:attr:: assignment_activity_sid

		The Activity to assign a Worker when they accept a Task from this TaskQueue. Defaults to 'Unavailable for Assignment'.

	.. php:attr:: max_reserved_workers

		The maximum amount of workers to create reservations for the assignment of a task while in this queue.

Task
====================

.. php:class:: Services_Twilio_Rest_TaskRouter_Task

	.. php:attr:: sid

		The unique ID of the Task

   	.. php:attr:: account_sid

		The ID of the account that owns this Task

	.. php:attr:: workspace_sid

		The ID of the Workspace that holds this Task

	.. php:attr:: workflow_sid

		The ID of the Workflow responsible for routing this Task

	.. php:attr:: attributes

		The user-defined JSON string describing the custom attributes of this work.

	.. php:attr:: age

		The number of seconds since this task was created.

	.. php:attr:: priority

		The current priority score of the task, as assigned by the workflow. Tasks with higher values will be assigned before tasks with lower values.

	.. php:attr:: task_queue_sid

		The current TaskQueue occupied, controlled by the Workflow's Workflow.

	.. php:attr:: assignment_status

		A string representing the Assignment State of the task. May be pending, reserved, assigned or canceled. See the table of Task Assignment Status values below for more information.

	.. php:attr:: reason

		The reason the task was canceled (if applicable)

	.. php:attr:: date_created

		Date this task was created, given as ISO 8601 format.

	.. php:attr:: date_updated

		Date this task was updated, given as ISO 8601 format.

	.. php:attr:: timeout

		The amount of time in seconds the task is allowed to live

Activity
========================

.. php:class:: Services_Twilio_Rest_TaskRouter_Activity

	.. php:attr:: sid

		The unique ID for this Activity.

   	.. php:attr:: account_sid

		The unique ID of the Account that owns this Activity.

	.. php:attr:: workspace_sid

		The unique ID of the Workspace that this Activity belongs to.

	.. php:attr:: friendly_name

		A human-readable name for the Activity, such as 'on-call', 'break', 'email', etc. These names will be used to calculate and expose statistics about workers, and give you visibility into the state of each of your workers.

	.. php:attr:: available

		Boolean value indicating whether the worker should be eligible to receive a Task when they occupy this Activity. For example, in an activity called 'On Call', the worker would be unavailable to receive additional Task assignments.

	.. php:attr:: date_created

		The date this Activity was created.

	.. php:attr:: date_updated

		The date this Activity was updated.

Event
========================

.. php:class:: Services_Twilio_Rest_TaskRouter_Event

	.. php:attr:: event_type

		An identifier for this event

	.. php:attr:: account_sid

		The account owning this event

	.. php:attr:: description

		A description of the event

	.. php:attr:: resource_type

		The type of object this event is most relevant to (Task, Reservation, Worker)

	.. php:attr:: resource_sid

		The sid of the object this event is most relevant to (TaskSid, ReservationSid, WorkerSid)

	.. php:attr:: event_date

		The time this event was sent

	.. php:attr:: event_data

		Data about this specific event 


Reservation
========================

.. php:class:: Services_Twilio_Rest_TaskRouter_Reservation

	.. php:attr:: sid

		The unique ID of this Reservation

	.. php:attr:: account_sid

		The ID of the Account that owns this Task

	.. php:attr:: workspace_sid

		The ID of the Workspace that this task is contained within

	.. php:attr:: task_sid

		The ID of the reserved Task

	.. php::attr:: worker_sid

		The ID of the reserverd Worker

	.. php:attr:: worker_name

		Human readable description of the Worker that is reserved

	.. php:attr:: reservation_status

		The current status of the reservation 


Workspace Statistics
===========================

.. php:class:: Services_Twilio_Rest_TaskRouter_WorkspaceStatistics

	.. php:attr:: longest_task_waiting_sid

		The ID of the longest waiting Task

	.. php:attr:: longest_task_waiting_age

		The age of the longest waiting Task

	.. php:attr:: total_tasks

		The total number of Tasks

	.. php:attr:: total_workers

		The total number of Workers in the workspace

	.. php:attr:: tasks_by_status

		The Tasks broken down by status (for example: pending: 1, reserved = 3, assigned = 2)

	.. php:attr:: activity_statistics

		A breakdown of Workers by Activity (for example: Idle : 0, Busy: 5, Reserved = 0, Offline = 2)

	.. php:attr:: tasks_created

		The total number of Tasks created

	.. php:attr:: tasks_canceled

		The total number of Tasks that were canceled

	.. php:attr:: tasks_deleted

		The total number of Tasks that were deleted

	.. php:attr:: tasks_moved

		The total number of Tasks that were moved from one queue to another

	.. php:attr:: tasks_timed_out_in_workflow

		The total number of Tasks that were timed out of their Workflows (and deleted)

	.. php:attr:: avg_task_acceptance_time

		The average time (in seconds) from Task creation to acceptance

	.. php:attr:: reservations_created

		The total number of Reservations that were created for Workers

	.. php:attr:: reservations_accepted

		The total number of Reservations accepted by Workers

	.. php:attr:: reservations_rejected

		The total number of Reservations that were rejected

	.. php:attr:: reservations_timed_out

		The total number of Reservations that were timed out

	.. php:attr:: reservations_canceled

		The total number of Reservations that were canceled

	.. php:attr:: reservations_rescinded

		The total number of Reservations that were rescinded


Workflow Statistics 
======================

.. php:class:: Services_Twilio_Rest_TaskRouter_WorkflowStatistics

	.. php:attr:: longest_task_waiting_sid

		The ID of the longest waiting Task

	.. php:attr:: longest_task_waiting_age

		The age of the longest waiting Task

	.. php:attr:: total_tasks
		
		The total number of Tasks

	.. php:attr:: tasks_by_status

		The Tasks broken down by status (for example: pending: 1, reserved = 3, assigned = 2)

	.. php:attr:: tasks_entered

		The total number of Tasks that entered this Workflow

	.. php:attr:: tasks_canceled

		The total number of Tasks that were canceled

	.. php:attr:: tasks_deleted

		The total number of Tasks that were deleted

	.. php:attr:: tasks_moved

		The total number of Tasks that were moved from one queue to another

	.. php:attr:: tasks_timed_out_in_workflow

		The total number of Tasks that were timed out of their Workflows (and deleted)

	.. php:attr:: avg_task_acceptance_time

		The average time (in seconds) from Task creation to acceptance

	.. php:attr:: reservations_created

		The total number of Reservations that were created for Workers

	.. php:attr:: reservations_accepted

		The total number of Reservations accepted by Workers

	.. php:attr:: reservations_rejected

		The total number of Reservations that were rejected

	.. php:attr:: reservations_timed_out

		The total number of Reservations that were timed out

	.. php:attr:: reservations_canceled

		The total number of Reservations that were canceled

	.. php:attr:: reservations_rescinded

		The total number of Reservations that were rescinded

Worker Statistics 
======================

.. php:class:: Services_Twilio_Rest_TaskRouter_WorkerStatistics

	.. php:attr:: reservations_created

		The total number of Reservations that were created

	.. php:attr:: reservations_accepted

		The total number of Reservations accepted

	.. php:attr:: reservations_rejected

		The total number of Reservations that were rejected

	.. php:attr:: reservations_timed_out

		The total number of Reservations that were timed out

	.. php:attr:: reservations_canceled

		The total number of Reservations that were canceled

	.. php:attr:: activity_duration

		The minimum, average, maximum and total time (in seconds) this Worker spent in each Activity


TaskQueue Statistics 
======================

.. php:class:: Services_Twilio_Rest_TaskRouter_TaskQueueStatistics

	.. php:attr:: longest_task_waiting_sid

		The ID of the longest waiting Task

	.. php:attr:: longest_task_waiting_age

		The age of the longest waiting Task

	.. php:attr:: total_tasks

		The total number of Tasks

	.. php:attr:: tasks_by_status

		The Tasks broken down by status (for example: pending: 1, reserved = 3, assigned = 2)

	.. php:attr:: activity_statistics

		The current Worker status count breakdown by Activity

	.. php:attr:: total_eligible_workers

		The total number of Workers eligible for Tasks in this TaskQueue

	.. php:attr:: total_available_workers

		The total number of Workers available for Tasks in this TaskQueue

	.. php:attr:: tasks_entered

		The total number of Tasks entered into this TaskQueue

	.. php:attr:: tasks_canceled

		The total number of Tasks canceled while in this TaskQueue

	.. php:attr:: tasks_deleted

		The total number of Tasks that were deleted while in this TaskQueue

	.. php:attr:: tasks_moved

		The total number of Tasks moved to another TaskQueue from this TaskQueue

	.. php:attr:: avg_task_acceptance_time

		The average time (in seconds) from Task creation to acceptance while in this TaskQueue

	.. php:attr:: reservations_accepted

		The total number of Reservations that were accepted for Tasks while in this TaskQueue

	.. php:attr:: reservations_rejected

		The total number of Reservations that were rejected for Tasks while in this TaskQueue

	.. php:attr:: reservations_timed_out

		The total number of Reservations that were tiemd out for Tasks while in this TaskQueue

	.. php:attr:: reservations_canceled

		The total number of Reservations that were canceled for Tasks while in this TaskQueue

	.. php:attr:: reservations_rescinded

		The total number of Reservations that were rescinded 
