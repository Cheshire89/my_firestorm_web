<?php
class Payment extends fireSQL{
		
		private $userID;
		
		function Payment($userId){
			$this->userID = $userId;
		}

		function get_customer_id(){
			$customerData = $this->select('users', array('customerID'), array('userID'=>$this->userID));
			$result = $customerData->fetch_assoc();
			return $result["customerID"];
		}

		function get_payment_profiles(){
			$customerID = $this->get_customer_id();
			$paymentProfilesObj = $this->select('paymentMethods', array("*"), array('customerID'=>$customerID));
			return $paymentProfilesObj;
		}

		function get_payment_history(){
			$customerID = $this->get_customer_id();
			$paymnetHistoryObj = $this->select('payment', array("*"), array('anetProfileID'=>$customerID));
			return $paymnetHistoryObj;
		}

		function payment_profiles_table_html(){
			$paymentProfilesObj = $this->get_payment_profiles();
			$resultHtml = '';
            $numRows = $paymentProfilesObj->num_rows;
            //print("numrows: ".$paymentProfilesObj->num_rows);
			while($row = $paymentProfilesObj->fetch_assoc()){
				$card = $this->change_display_formating($row);
                $main = $row['mainPayment'];
                if($main != '1') {
                    $subBtn = '<button type="button" class="btn fs-btn-orange btn-sm pull-right updateSubscriptionPayment" data-id="'.$card["paymentID"].'">Set for Subscription</button>';
                } else {
                    $subBtn = '';
                }
                
				$resultHtml .= '<tr >
                   <td class="table-checkbox">
                        <input type="checkbox" name="select-row" id="'.$card["paymentID"].'">
                        <label for="'.$card["paymentID"].'">
                        </label>
                    </td>
                    <td><span>'.$card["cardNum"].'</span></td>
                    <td>'.$card["cardType"].'</td>
                    <td></td>
                    <td>'.$subBtn.'</td>
                    <td class="primary text-center">';

                if($card["primary"] > 0){
                	$resultHtml .= '<i class="fa fa-check-circle" aria-hidden="true"></i>';
                }
                
                if($main != '1') {
                    $deleteBtn = '<button type="button" class="btn fs-btn-orange btn-sm pull-right delete-payment" data-id="'.$card["paymentID"].'">Delete</button>';
                } else {
                    $deleteBtn = '';
                }
                
                $resultHtml .= '</td>
                    <td>'.$deleteBtn.'</td>   
                  </tr>';
			}
			return $resultHtml;
		}

		function payment_history_table(){
			$paymentHistoryObj = $this->get_payment_history();
			$resultHtml='';
			$i = 1;
			while($row = $paymentHistoryObj->fetch_assoc()){
				if($row["anetProfileType"] !== 'Error'){

				$resultHtml .= '<tr>
					   <td>'.$i.'</td>
                       <td>'.$row["anetProfileType"].'</td>
                       <td>'.$row["paymentFrequency"].' Payment</td>
                       <td>$'.$row["price"].'</td>
                       <td>'.$row["anetTransactionDate"].'</td>
                       
                       <td>'.$row["lastFour"].'</td>
                       <td class="primary text-center">';

		                if($row["primary"] > 0){
		                	$resultHtml .= '<i class="fa fa-check-circle" aria-hidden="true"></i>';
		                }

					        $resultHtml .= '</td>
			                       <td><button type="button" class="btn fs-btn-orange btn-sm pull-right delete-payment" data-id="'.$row["anetTransactionID"].'">Set</button></td>
			                    </tr>';
			        $i++;
			    	}
				}

			return $resultHtml;

		}
        
        function getSubscriptionID($userID) {
            $subscriptionID = $this->select('payment', array("anetPaymentID"), array('userID'=>$userID, 'anetProfileType'=>'Subscription'));
            $results = $subscriptionID->fetch_assoc();
            $subscriptionID = $results['anetPaymentID'];
            return $subscriptionID;
        }

		function set_payment_icon($cardType){
			switch ($cardType) {
				case 'Visa':
					$icon = '<i style="color: #1a1f71;" class="fa fa-cc-visa" aria-hidden="true"></i>';
					return $icon;
					break;

				case 'MasterCard':
					$icon = '<i style="color: #eb001b;" class="fa fa-cc-mastercard" aria-hidden="true"></i>';
					return $icon;
					break;

				case 'American Express':
				case 'AmericanExpress':
					$icon = '<i class="fa fa-cc-amex" style="color: #37B1E6" aria-hidden="true"></i>';
					return $icon;
					break;

				case 'Discover':
					$icon = '<i class="fa fa-cc-discover" style="color: #ff6600" aria-hidden="true"></i>';
					return $icon;
					break;

				default:
					return 'Card Not Supported';
					break;
			}
		}

		function change_display_formating($cardArray){
			$card = array();
			$cardIcon = $this->set_payment_icon($cardArray["cardType"]);
			$card["paymentID"] = $cardArray["paymentProfileID"];
			$card["cardNum"] = $cardIcon.' '.str_replace('X', '.', $cardArray["cardNum"]);
			$card["cardType"] = $cardArray["cardType"];
			$card["primary"] = $cardArray["primary"];
			return $card;
		}
}
?>