<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rental Agreement #{{ $agreement->id }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 14px; line-height: 1.4; color: #000; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .title { font-size: 28px; font-weight: bold; margin-bottom: 5px; }
        .subtitle { font-size: 22px; font-weight: bold; margin-bottom: 5px; text-transform: uppercase; }
        .header-info { font-size: 16px; font-style: italic; margin-bottom: 20px; }
        
        .section-title { font-size: 16px; font-weight: bold; margin-top: 20px; margin-bottom: 10px; }
        .row { width: 100%; clear: both; margin-bottom: 10px; }
        .col-half { width: 48%; float: left; }
        .col-half-right { width: 48%; float: right; }
        .clear { clear: both; }
        
        .line-input { border-bottom: 1px solid #000; display: inline-block; padding: 0 5px; min-width: 200px; }
        .label { display: inline-block; width: 120px; }
        
        .checkbox-row { margin-bottom: 10px; }
        .checkbox { display: inline-block; width: 12px; height: 12px; border: 1px solid #000; margin-left: 5px; margin-right: 20px; }
        .checked { background-color: #000; }
        
        .text-sm { font-size: 11px; margin-top: 15px; margin-bottom: 15px; text-align: justify; }
        
        .signature-box { border-bottom: 1px solid #000; min-width: 250px; display: inline-block; position: relative; height: 50px; vertical-align: bottom; }
        .signature-img { position: absolute; bottom: 0; left: 0; max-height: 50px; max-width: 250px; }
        
        .page-break { page-break-after: always; }
        
        .terms-header { text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 10px; }
        .terms-text { font-size: 10px; text-align: justify; line-height: 1.3; }
        .terms-text p { margin-bottom: 8px; margin-top: 0; }
    </style>
</head>
<body>
    <div class="text-center">
        <div class="title">W.M. Enterprises</div>
        <div class="subtitle">Car Rental Agreement</div>
        <div class="header-info">Rock Sound, Eleuthera, Tele: 242-376-1454</div>
    </div>

    <div class="section-title">Driver's Information</div>
    <div class="row">
        <div class="col-half">
            <span class="label">First Name:</span> <span class="line-input">{{ $agreement->first_name }}</span>
        </div>
        <div class="col-half-right">
            <span class="label">Last Name:</span> <span class="line-input">{{ $agreement->last_name }}</span>
        </div>
    </div>
    <div class="clear"></div>
    <div class="row">
        <div class="col-half">
            <span class="label">Date of Birth:</span> <span class="line-input">{{ \Carbon\Carbon::parse($agreement->date_of_birth)->format('m/d/Y') }}</span>
        </div>
        <div class="col-half-right">
            <span class="label">Driver's License:</span> <span class="line-input">{{ $agreement->drivers_license }}</span>
        </div>
    </div>
    <div class="clear"></div>
    <div class="row" style="margin-bottom: 20px;">
        <span class="label">Address:</span> <span class="line-input" style="width: 200px;">{{ $agreement->address }}</span>
        <span style="display:inline-block; width:50px;">Email:</span> <span class="line-input" style="min-width: 150px;">{{ $agreement->email }}</span>
        <span style="display:inline-block; width:50px;">Phone:</span> <span class="line-input" style="min-width: 120px;">{{ $agreement->phone }}</span>
    </div>

    <div class="section-title">Pick Up Location</div>
    <div class="checkbox-row">
        Rock Sound International Airport <span class="checkbox {{ str_contains($agreement->pickup_location, 'Rock Sound') ? 'checked' : '' }}"></span>
        Governor's Harbour International Airport <span class="checkbox {{ str_contains($agreement->pickup_location, 'Governor') ? 'checked' : '' }}"></span>
    </div>
    <div class="row">
        <div class="col-half">
            <span class="label" style="width:150px;">Pick Up Date:</span> <span class="line-input">{{ \Carbon\Carbon::parse($agreement->pickup_date)->format('m/d/Y') }}</span>
        </div>
        <div class="col-half-right">
            <span class="label" style="width:150px;">Pick Up Time:</span> <span class="line-input">{{ \Carbon\Carbon::parse($agreement->pickup_time)->format('h:i A') }}</span>
        </div>
    </div>
    <div class="clear" style="margin-bottom: 20px;"></div>

    <div class="section-title">Return Location</div>
    <div class="checkbox-row">
        Rock Sound International Airport <span class="checkbox {{ str_contains($agreement->return_location, 'Rock Sound') ? 'checked' : '' }}"></span>
        Governor's Harbour International Airport <span class="checkbox {{ str_contains($agreement->return_location, 'Governor') ? 'checked' : '' }}"></span>
    </div>
    <div class="row">
        <div class="col-half">
            <span class="label" style="width:150px;">Return Date:</span> <span class="line-input">{{ \Carbon\Carbon::parse($agreement->return_date)->format('m/d/Y') }}</span>
        </div>
        <div class="col-half-right">
            <span class="label" style="width:150px;">Return Time:</span> <span class="line-input">{{ \Carbon\Carbon::parse($agreement->return_time)->format('h:i A') }}</span>
        </div>
    </div>
    <div class="clear" style="margin-bottom: 20px;"></div>

    <div class="section-title">Vehicle Information:</div>
    <div class="row">
        <span style="display:inline-block; width:45px;">Class:</span> <span class="line-input" style="min-width: 80px;">Standard</span>
        <span style="display:inline-block; width:65px;">Gearbox:</span> <span class="line-input" style="min-width: 80px;">Auto</span>
        <span style="display:inline-block; width:45px;">Make:</span> <span class="line-input" style="min-width: 100px;">{{ $agreement->vehicle->make ?? '' }}</span>
        <span style="display:inline-block; width:45px;">Model:</span> <span class="line-input" style="min-width: 100px;">{{ $agreement->vehicle->model ?? '' }}</span>
    </div>
    <div class="row" style="margin-bottom: 20px;">
        <span style="display:inline-block; width:120px;">Max passengers:</span> <span class="line-input" style="min-width: 50px;">5</span>
        <span style="display:inline-block; width:40px; margin-left: 20px;">Fuel:</span> <span class="line-input" style="min-width: 50px;">Gas</span>
    </div>

    <div class="text-sm">
        The individual mentioned above in this Car Rental Contract hereby agrees to fill the fuel tank at the above indicated level upon returning the car. Failure to fill the tank at the prescribed level will result in an additional penalty of $20.00 per quarter tank of fuel.<br><br>
        We maintain a smoke free rental fleet. There is to be no smoking in the above-described vehicle. If you are caught smoking in the above-described vehicle there will be a charge of <strong>$250.00</strong>.
    </div>

    <div class="section-title">Rental Period: Pick up date: <span class="line-input" style="font-weight:normal;">{{ \Carbon\Carbon::parse($agreement->pickup_date)->format('m/d/Y') }}</span> &nbsp;&nbsp;&nbsp;&nbsp; Return Date: <span class="line-input" style="font-weight:normal;">{{ \Carbon\Carbon::parse($agreement->return_date)->format('m/d/Y') }}</span></div>

    <div class="section-title" style="margin-top: 30px;">Pricing</div>
    <div class="row" style="margin-bottom: 20px;">
        <span class="label" style="width: 100px;">Price per day:</span> <span class="line-input" style="min-width: 100px;">${{ number_format($agreement->price_per_day, 2) }}</span>
        <span class="label" style="width: 60px;">Deposit:</span> <span class="line-input" style="min-width: 100px;">${{ number_format($agreement->deposit, 2) }}</span>
        <span class="label" style="width: 70px;">Total Due:</span> <span class="line-input" style="min-width: 100px;">${{ number_format($agreement->total_due, 2) }}</span>
    </div>

    <div class="section-title">Payment Type:</div>
    <div class="checkbox-row" style="margin-bottom: 30px;">
        Cash <span class="checkbox {{ $agreement->payment_type === 'Cash' ? 'checked' : '' }}"></span>
        Credit Card <span class="checkbox {{ $agreement->payment_type === 'Credit Card' ? 'checked' : '' }}"></span>
        Direct Deposit <span class="checkbox {{ $agreement->payment_type === 'Direct Deposit' ? 'checked' : '' }}"></span>
    </div>

    <div class="row" style="margin-bottom: 30px;">
        I agree to the terms and conditions <span class="checkbox {{ $agreement->agreed_to_terms ? 'checked' : '' }}"></span>
    </div>

    <div class="row" style="margin-bottom: 40px;">
        <div class="col-half">
            Renter's Name: <span class="line-input">{{ $agreement->renter_name }}</span>
        </div>
        <div class="col-half-right">
            Signature: 
            <span class="signature-box">
                @if($agreement->renter_signature)
                    <img src="{{ $agreement->renter_signature }}" class="signature-img">
                @endif
            </span>
        </div>
    </div>
    <div class="clear"></div>

    <div class="row" style="margin-bottom: 40px;">
        <div class="col-half">
            Company Representative's Name: <span class="line-input">{{ $agreement->company_representative_name ?? '' }}</span>
        </div>
        <div class="col-half-right">
            Signature: 
            <span class="signature-box">
                @if($agreement->company_signature)
                    <img src="{{ $agreement->company_signature }}" class="signature-img">
                @endif
            </span>
        </div>
    </div>
    <div class="clear"></div>

    <div class="row">
        Date: <span class="line-input" style="width: 250px;">{{ $agreement->signed_at ? \Carbon\Carbon::parse($agreement->signed_at)->format('m/d/Y') : '' }}</span>
    </div>

    <div class="page-break"></div>

    <div class="terms-header">
        TERMS AND CONDITIONS<br>
        <span style="font-weight:normal; font-size:10px;">W. Major Enterprises Car Rental is committed to respecting the privacy of individuals and recognizes a need for the appropriate management and protection of any personal information that you agree to provide to us. We will not share your information with any third party outside of our organization, other than as necessary to full fill reservations and /OR vehicle renting requests.</span>
    </div>

    <div class="terms-text">
        <p style="text-align:center; font-weight:bold; font-size:12px;">RENTAL AGREEMENT</p>
        <p>This is an AGREEMENT between you, the RENTER/DRIVER(S) and the COMPANY to rent a motor VEHICLE (including tires, tools, accessories and equipment). The RENTER/DRIVER(S) acknowledges the vehicle is the property of the COMPANY although registered title may be in a third party and/or corporate name. The COMPANY which is renting this VEHICLE to you is more fully described in the header of this agreement. The RENTER/DRIVER(S) is identified on the top left side of this agreement. The RENTER/DRIVER(S) is renting the VEHICLE from the COMPANY and you the RENTER/DRIVER(S) must sign this agreement. By signing this agreement, you, the RENTER/DRIVER(S), are entering into a contract with the COMPANY for the use of the COMPANY'S VEHICLE. You are agreeing to pay on demand the rental charges referred to on page 1. By entering into the contract you are subject to the following terms and conditions.</p>
        
        <p><strong>1. AUTHORIZED USE</strong><br>
        The VEHICLE may be used ONLY by an AUTHORIZED DRIVER. An AUTHORIZED DRIVER is: (a) You, the RENTER/LICENSED DRIVER(S), and/or; (b) A licensed driver who has been accepted by the COMPANY as an additional RENTER as referred to on page 1 on the other side of this agreement.</p>
        
        <p><strong>2. PROHIBITED USE</strong><br>
        You the RENTER/DRIVER(S), agree that the VEHICLE shall not be: (a) used to carry persons or property for hire; (b) used to propel or tow any vehicle, trailer or other object; (c) used in any race, driver test and/or speed test or contest; (d) used by any person who there is reasonable evidence to suggest they are under the influence of alcohol, intoxicants, narcotics, or other substances to an extent prohibited by law; (e) used in the commission of any crime, or for any illegal trade or transport; (f) removed from the island/country of rental without obtaining the prior written consent of the COMPANY or COMPANY's representative; (g) used by anyone for whom the COMPANY has been given a false name, age, address, driver's license, credit card, other information, or who does not have a valid driver's license; (h) used in a dangerous, reckless or imprudent manner; (i) used on other than a public highway or graded road or driveway; (j) left without securing the vehicle and its keys.</p>

        <p><strong>3. VEHICLE CONDITION AND RETURN</strong><br>
        The VEHICLE is delivered to you in good operating condition. You agree to return the VEHICLE in the same condition in which you received it (except for ordinary wear and tear) to the COMPANY'S location at the place and on the date specified on page 1 of this agreement, or sooner on demand by the COMPANY. If you return the VEHICLE to an unauthorized location not specified on page 1 of this agreement you will be charged one of the following: (1) Additional daily rate(s) plus a one-way service charge as determined by the COMPANY. You will pay to the COMPANY on demand all loss or damage to the rented VEHICLE regardless of the manner by which such damage was incurred, while rented under this agreement. Any total loss shall be calculated as the replacement cost of the rented vehicle as described on page 2 of this agreement plus any and all expenses. You will pay to the COMPANY on demand all towing charges, storage charges, impound fees, claims administration charges, diminished value of said vehicle and damages for loss of use for the vehicle while being repaired and/or out of service.</p>
        <p>The COMPANY has the right to monitor, track and locate the VEHICLE through remote tracking devices or otherwise. The COMPANY has the right to disable and repossess the vehicle through remote tracking devices or otherwise without demand at your expense at any time if it is illegally parked, used in breach of the geographic driving restrictions or used in violation of any law, payment obligations under this agreement, or vehicle appears to be apparently abandoned. You will be required to pay the full amount of the loss or damage to the vehicle.</p>
        
        <p><strong>4. LIABILITY INSURANCE</strong><br>
        The COMPANY has obtained all mandatory automobile insurance as required by law with respect to the VEHICLE. By driving this VEHICLE, AUTHORIZED DRIVERS are agreeing to comply and be bound by all terms, conditions, limitation and restrictions of this insurance policy which are made a part of this rental agreement. The COMPANY will not provide "uninsured motorists", "under insured motorists", "supplemental", "no fault", or any other optional insurance coverage unless such coverage is required by law. To the extent permitted by law, the RENTER/DRIVER(S) and the COMPANY reject the inclusion of any such optional coverage.</p>
        
        <p><strong>5. POWER OF ATTORNEY</strong><br>
        RENTER/DRIVER(S) hereby grants and appoints to owner a Limited Power of Attorney to present insurance claims for property damage to RENTER/DRIVER(S) insurance carrier if the rented vehicle is damaged during the term of this rental agreement; and to endorse RENTER/DRIVER(S) name on insurance payments for charges or damages.</p>
        
        <p><strong>6. GENERAL PROVISIONS</strong><br>
        (a) PAYMENT. If the AUTHORIZED DRIVER fails to make payments required under the agreement to the COMPANY, all expenses of collection and/or repossession, including court costs and lawyer fees incurred by the COMPANY in pursuing the claim against the AUTHORIZED RENTER/DRIVER(S) will be paid by the AUTHORIZED RENTER/DRIVER(S). If the AUTHORIZED RENTER/DRIVER(S) has directed the COMPANY to bill charges to some other person, firm, or organization which fails to make payment promptly when due, the RENTER/DRIVER(S) will promptly pay the COMPANY upon demand. ALL CHARGES ARE SUBJECT TO FINAL AUDIT and resulting credits and additional charges will be made and paid by the method used in the initial transaction, 2% PER MONTH (24% PER YEAR) CHARGED ON OVERDUE ACCOUNTS. An administrative cost of carrying the account may be applied.<br>
        (b) FINES AND PENALTIES: AUTHORIZED RENTER/DRIVER(S) will pay all fines, penalties, forfeitures and court costs imposed for parking, and/or traffic violations with respect to the VEHICLE while rented under this agreement. The RENTER/DRIVER(S) will promptly report such violations to the COMPANY and will hold the COMPANY harmless from all claims arising out of such violations.<br>
        (c) AUTHORIZED RENTER/DRIVER(S) releases and holds harmless the COMPANY (and its agents and employees) from all claims for loss or damage to his or her personal property or that of any other person, which is left or carried in or upon the VEHICLE or in or upon any other VEHICLE or premises of the COMPANY by AUTHORIZED DRIVER, or by any other person, or which is received, handled or stored by the COMPANY, at any time before, during or after this rental, whether or not due to the COMPANY'S negligence or fault.<br>
        (d) NOTICE: In addition to all requirements of an AUTHORIZED RENTER/DRIVER(S) under the insurance policy, and AUTHORIZED RENTER/DRIVER(S) will immediately report any accident to the COMPANY at the location where the vehicle was rented and will deliver to the COMPANY at the location every Writ, Summons, Complaint or Paper of any kind received by an AUTHORIZED RENTER/DRIVER(S) in any way relating to any accident involving the VEHICLE while rented under this agreement. An AUTHORIZED RENTER/DRIVER(S) also agrees to fully co-operate with the COMPANY in the investigation and defense of any claim or lawsuit.<br>
        (e) In no event shall an AUTHORIZED RENTER/DRIVER(S) of the VEHICLE be or be deemed to be the agent, servant, or employee, of the COMPANY in any matter or for any purpose whatsoever.<br>
        (f) THE COMPANY MAKES NO WRITTEN, EXPRESSED OR IMPLIED WARRANTY AS TO ANY MATTER WHATSOEVER INCLUDING WITHOUT LIMITATION THE CONDITION OF THE VEHICLE AND EQUIPMENT OR FITNESS FOR ANY PARTICULAR PURPOSE.<br>
        (g) No right of the COMPANY under this agreement may be waived except in writing by an officer of the COMPANY.<br>
        (h) REPAIRS: RENTER/DRIVER(S) shall not permit any repairs to the VEHICLE or suffer any lien to be placed upon it without COMPANY'S prior written consent. RENTER/DRIVER(S) shall be liable for any such repairs.<br>
        (i) RENTER/DRIVER(S) is liable for any damages sustained to the vehicle until it is inspected and accepted by the COMPANY.<br>
        (k) An administration charge, not to exceed $100.00 will be charged to RENTER/DRIVER(S) in the event of a credit card chargeback that is proved to be valid to the cardholders issuing bank.<br>
        (l) Authorized drivers shall comply with all jurisdictional highway and traffic laws, applicable seatbelt and child restraint laws.</p>
    </div>
</body>
</html>
