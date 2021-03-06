<?php

require_once (IBSINC."generator/report_generator/report_generator_controller.php");
require_once ("connection_logs_report_generator_controller.php");
require_once ("connection_logs_web_report_generator.php");
require_once ("admin_connection_logs_report_creator.php");

class AdminConnectionLogsReportGeneratorController extends ConnectionLogsReportGeneratorController
{
    function AdminConnectionLogsReportGeneratorController()
	{
		parent :: ConnectionLogsReportGeneratorController();
	
        $this->total_rows = 0;
        $this->total_credit = 0;
        $this->total_duration = 0;
        $this->total_in_bytes = 0;
        $this->total_out_bytes = 0;
	}

	function extractVarsFromResults ($results)
	{
	    $this->total_rows = $results["total_rows"];
        $this->total_credit = $results["total_credit"];
        $this->total_duration = $results["total_duration"];
        $this->total_in_bytes = $results["total_in_bytes"];
        $this->total_out_bytes = $results["total_out_bytes"];
	}
	
	function getCreator ()
	{
	    return new AdminConnectionLogsReportCreator ();
	}

	function init()
	{
		parent :: init();
		$this->registerGenerator("WEB", "createAdminWebGenerator");
	}

	/**
	 * get report selectors
	 * @return array selectors
	 * */
	function getReportSelectors() {
		return array_merge(array (
			"User ID" => "show__user_id|createLinkConnectionLogsUserID"
		), parent :: getReportSelectors());
	}
}

/**
 * get geneartor for web
 * */
function createAdminWebGenerator()
{
	return new ConnectionLogsWebReportGenerator();
}
