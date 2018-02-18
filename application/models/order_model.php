<?php
class Order_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function getOrderCount($status)
	{
		$sql = "SELECT * FROM kyd_orders WHERE status = '".$status."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function getOrders($status)
	{
		$sql = "SELECT * FROM kyd_orders WHERE status = '".$status."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getOrder($id)
	{
		$sql = "SELECT * FROM kyd_orders WHERE id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function getHandler($id)
	{
		if($id == 0)
		{
			return "Not Handled Yet!";
		}
		$sql = "SELECT * FROM kyd_admin WHERE id = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->name;
	}
	function getProcessedOrders()
	{
		$sql = "SELECT * FROM kyd_orders WHERE status != 'pending' ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getOrderStatus($status)
	{
		$class = '';
		switch($status)
		{
			case 'pending' : $class = "label label-danger";
								break;
			case 'invalid' : $class = "label label-default";
								break;
			case 'in_progress' : $class = "label label-warning";
								break;
			case 'completed' : $class = "label label-success";
								break;
			case 'cancelled' : $class = "label label-info";
								break;
			case 'messaged' : $class = "label label-primary";
								break;
			
		}
		return $class;
	}
	function getDealValue($price, $deal)
	{
		$value = $price * ($deal / 100);
		return $value;
	}
	function updateOrder($status, $handler, $id)
	{
		$sql = "UPDATE kyd_orders SET status = '".$status."', handler_id = '".$handler."' WHERE id = '".$id."'";
		if($this->db->query($sql))
		{
			return true;
		}
		else return false;
		
	}
}

?>
