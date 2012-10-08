=============
Usage Records
=============

Retrieve All Usage Records
==========================

.. code-block:: php

    $client = new Services_Twilio('AC123', '456bef');
    foreach ($client->account->usage->records as $record) {
        echo "Record: $record";
    }

Retrieve Usage Records For A Time Interval
==========================================

UsageRecords support `several convenience subresources
<http://www.twilio.com/docs/api/rest/usage-records#list-subresources>`_ that
can be accessed as properties on the `record` object.

.. code-block:: php

    $client = new Services_Twilio('AC123', '456bef');
    foreach ($client->account->usage->records->last_month as $record) {
        echo "Record: $record";
    }

Retrieve Usage Records for A Usage Category
===========================================

.. code-block:: php

    $client = new Services_Twilio('AC123', '456bef');
    $smsRecord = $client->account->usage->records->getCategory('sms');
    echo $smsRecord->usage;

