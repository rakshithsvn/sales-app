<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" href="{{ public_path('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ public_path('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ public_path('assets/css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ public_path('assets/css/bootstrap.css') }}">

    <style type="text/css">
      @media print {
        @page {size: landscape}
    }
    table { width: 100%}
    table td{ padding: 10px !important; border: 1px solid #000}
</style>

</head>

<body>
    <div class="container light-blue">
        <div class="d-flex justify-content-center">
            {{-- <div><img src="./assets/images/logo/logo-dark.png" class="img-fluid mb-3 marksheet"></div> --}}
            <div class="mt-3"><h4>Sales App</h4>
            <p>Building a better fleet begins here</p>
            <p>Offering one-stop solutions for all your fleet management needs, Sales App delivers transformative solutions to any company with a fleet of vehicles, small or large.</p>

            </div>
        </div>

    <div class="table-responsive">
        <table class="table table-bordered" style="border:0">
            <tbody>
                <tr>
                    <td>Number of Vehicles</td>
                    <td>{{ @$input['no_vehicle'] }}</td>
                </tr>
                <tr>
                    <td>Fuel Cost / month / vehicle (AED)</td>
                    <td>{{ @$input['fuel_cost_month'] }}</td>
                </tr>
                <tr>
                    <td>Average driving hours / day HOURS)</td>
                    <td>{{ @$input['avg_hours'] }}</td>
                </tr>
                <tr>
                    <td>Distance driven / day / vehicle (KMS)</td>
                    <td>{{ @$input['distance'] }}</td>
                </tr>
                <tr>
                    <td>Average monthly salary / driver (AED)</td>
                    <td>{{ @$input['avg_salary'] }}</td>
                </tr>
            </tbody>
        </table>
        {{-- <table class="table table-bordered" style="border:1px solid #d7d7d7">
            <tr>
                    <td>One time Investment (AED)</td>
                    <td>Dh{{ @$admin_input->OTI }}</td>
                </tr>
                <tr>
                    <td>Recurring payment (AED)</td>
                    <td>Dh{{ @$admin_input->recurring_payment }}</td>
                </tr>
                <tr>
                    <td>Fuel Savings (%)</td>
                    <td>{{ @$admin_input->fuel_saving }}</td>
                </tr>
                <tr>
                    <td>Maintenance Saving (%)</td>
                    <td>{{ @$admin_input->maintenance_saving }}</td>
                </tr>
                <tr>
                    <td>Labour Saving (%)</td>
                    <td>{{ @$admin_input->labour_saving }}</td>
                </tr>
                <tr>
                    <td>Cost of Fuel (AED)</td>
                    <td>Dh{{ @$admin_input->fuel_cost }}</td>
                </tr>
                <tr>
                    <td>Annual Maintenance Multiplier</td>
                    <td>{{ @$admin_input->AMM }}</td>
                </tr>
                <tr>
                    <td>Total Working Days / Month</td>
                    <td>{{ @$admin_input->TWD }}</td>
                </tr>
                <tr>
                    <td>CO2 Emissions (Kgs/Litre)</td>
                    <td>{{ @$admin_input->CO2E }}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>Total Distance Saved / Month (KMS)</td>
                    <td>{{ @$calculate['TDS'] }}</td>
                </tr>
                <tr>
                    <td>Mileage</td>
                    <td>Dh{{ number_format(@$calculate['mileage'],2) }}</td>
                </tr>
                <tr>
                    <td>Total Fuel Saved / Month (LITRES)</td>
                    <td>{{ number_format(@$calculate['TFS'],2) }}</td>
                </tr>
                <tr>
                    <td>Total CO2 Emssions (TONNES)</td>
                    <td>{{ number_format(@$calculate['TCO2E'],2) }}</td>
                </tr>
                <tr>
                    <td><strong> Cost of Fuel Saved / Month (AED)</strong> </td>
                    <td><strong>Dh{{ number_format(@$calculate['TCFS'],2) }}</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Total Monthly Maintenance Cost (AED)</td>
                    <td>{{ @$calculate['TMMC'] }}</td>
                </tr>
                <tr>
                    <td><strong> Cost Saved / Month (AED)</strong> </td>
                    <td><strong>Dh{{ number_format(@$calculate['MCS'],2) }}</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Total Hours Saved / Month (Overtime) (HOURS)</td>
                    <td>{{ @$calculate['THS'] }}</td>
                </tr>
                <tr>
                    <td><strong> Value of Labour Savings / Month (Overtime Salary) (AED)</strong></td>
                    <td><strong>Dh{{ number_format(@$calculate['TVLS'],2) }}</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
    </table> --}}
    <p><strong>ROI Results</strong></p>
    <table class="table table-bordered" style="border:1px solid #d7d7d7">
        <tr>
            <td>&nbsp;</td>
            <td><strong>12 MONTHS</strong></td>
            <td><strong>36 MONTHS</strong></td>
        </tr>
        <tr>
            <td><strong>Approx. Distance Saved (KMS)</strong></td>
            <td>{{ number_format(@$output['ADS_12'],2) }}</td>
            <td>{{ number_format(@$output['ADS_36'],2) }}</td>
        </tr>
        <tr>
            <td><strong>CO2 Emissions reduced helping a greener planet (TONNES)</strong></td>
            <td>{{ number_format(@$output['CO2ER_12'],2) }}</td>
            <td>{{ number_format(@$output['CO2ER_36'],2) }}</td>
        </tr>
        <tr>
            <td><strong>Fuel ROI</strong></td>
            <td>{{ number_format(@$output['FROI_12']*100, 2) }}%</td>
            <td>{{ number_format(@$output['FROI_36']*100, 2) }}%</td>
        </tr>
        <tr>
            <td><strong>Maintenance ROI</strong></td>
            <td>{{ number_format(@$output['MROI_12']*100, 2) }}%</td>
            <td>{{ number_format(@$output['MROI_36']*100, 2) }}%</td>
        </tr>
        <tr>
            <td><strong>Approx. Overtime Hours Reduced (HOURS)</strong></td>
            <td>{{ number_format(@$output['AOHR_12'],2) }}</td>
            <td>{{ number_format(@$output['AOHR_36'],2) }}</td>
        </tr>
        <tr>
            <td><strong>Labour ROI</strong></td>
            <td>{{ number_format(@$output['LROI_12']*100, 2) }}%</td>
            <td>{{ number_format(@$output['LROI_36']*100, 2) }}%</td>
        </tr>
        <tr>
            <td><strong>Months to Break Even (MONTHS)</strong></td>
            <td colspan="2" align="center">{{ number_format(@$output['MBE'],2) }}</td>
        </tr>
        <tr>
            <td><strong>Total ROI</strong></td>
            <td>{{ number_format(@$output['TROI_12']*100, 2) }}%</td>
            <td>{{ number_format(@$output['TROI_36']*100, 2) }}%</td>
        </tr>
        <tr>
            <td><strong>Approx. Total Savings (AED)</strong></td>
            <td>Dh{{ number_format(@$output['ATS_12'],2) }}</td>
            <td>Dh{{ number_format(@$output['ATS_36'],2) }}</td>
        </tr>
    </tbody>
</table>

</div>
<br/>
<p>*The ROI Calculator provides only an estimate for informational purposes. It is the responsibility of each customer to determine if Sales App are appropriately suited to their own particular requirements.The information in this output has been provided as per industry standards, but we do not guarantee its accuracy, adequacy, validity, reliability, availability, or completeness.</p>
<p>Our services aren't just about business, but also about learning. We'd be happy to assist you in learning more about the above-estimated results and fleet management solutions. Get in touch with us today!</p><br/><hr/>
<p><strong>What makes fleet management the best solution for your business</strong></p>
<p>The right fleet management software can help you in streamlining business processes by monitoring fleet performance, making fleets fuel-efficient, streamlining business processes, maintaining strategic control of local and international fleets, reducing unnecessary costs and repetitive work along with regular fleet maintenance.</p>
<p>Our fleet management solution can help you in the following ways</p>
<ul>
    <li>Real-time tracking of your fleet</li>
    <li>Easy and convenient recovery of stolen fleets</li>
    <li>Track and monitor driver in real-time to improve his efficiency</li>
    <li>Asset tracking systems let you know where your assets are at all times and keep track of your
    entire inventory.</li>
    <li>Allows you to plot a course and follow a map easily.</li>
</ul>
<p>Schedule an appointment and let us clear up all your fleet management concerns.</p><br/><hr/>
<p><strong>The most accurate fleet data available anywhere, anytime</strong></p>
<p>We help you connect to everything from trucks, drivers, freight, and permanent assets. We offer custom fleet solutions for a variety of industries, including Food & Beverage, Cold Chain, Manufacturing, Passenger Transit, Construction, Transport & Logistics, or E-commerce.</p>
<p>Our fleet management solutions involve</p>
<ul>
    <li>Vehicle Tracking Solution</li>
    <li>Dispatch and Logistic Solution</li>
    <li>Taxi Management Solution</li>
    <li>School Bus Management</li>
    <li>Asset Trackers</li>
    <li>Personal Trackers</li>
    <li>Fuel and Temperature Monitoring Solutions</li>
</ul>
<p>Using Enterprise's award-winning technology, infrastructure, and fleet management expertise, we show
businesses how far an excellent fleet program can take them.</p>
<p>Get in touch with us to learn more about the wide variety of products and services we offer.</p><br/><hr/>
<p><strong>Why Sales App is the best in the fleet industry</strong></p>
<p>Experts in combining analytics, corporate strategy, digitalization, and years of experience to predict the future of fleets, we provide comprehensive logistics and fleet management solutions to improve efficiency, security, and cost reduction.</p>
<p>We offer,</p>
<ul>
    <li>Customized fleet solutions to meet individual business needs</li>
    <li>Solutions that are industry standard and evolve as technology advances</li>
    <li>Seamless implementation and an easy maintenance</li>
    <li>Simple and effective dashboards let you see the big picture at one glance</li>
    <li>A range of cost-effective solutions based on your budget</li>
    <li>24/7 Customer Support and Live Chat</li>
</ul>
<p><strong>We have helped 6000+ customers improve their business by 25% through our fleet management
solution.</strong></p>
<p>Allow us to be your resource in the expansion of your business to new highs.</p><br/><hr/>
</div>
</body>
</html>

