<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    td {
        border: none!important;
        background: #ebfef2;
    }
    table {
        background: #ebfef2;
        border:none!important;
        border-radius:20px;
    }
    .with-colors {
        background-color: green;
        color:#fff;
        border: none!important;
    }
    .spacing {
        padding:20px;
    }
    .md-fz {
        font-size:14px;
    }
    .form-control {
        border: 1px solid green;
    }
    .form-control[readonly] {
        background:#fff;
        
    }
</style>
<div class="loan-calculator mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                
                <form id="loanForms" action="" method="post" class="form-group" style="background-color: #ebfef2;">
                <h1 style="font-size: 20px; font-weight: bold; color:#fff; padding: 10px; background-color:green; border-top-left-radius: 20px; border-top-right-radius: 20px;">Filled in with preferred details</h1>
                    <div class="spacing">
                        <div class="form-group">
                            <label for="vehicle-category">Vehicle Category <i class="fas fa-exclamation-circle"></i></label>
                            <select id="vehicle-category" name="vehicle-category" class="form-control">
                                <option value="brand-new">Brand New</option>
                                <option value="pre-owned">Pre Owned</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="loan-term">Loan Term <i class="fas fa-exclamation-circle"></i></label>
                            <select id="loan-term" name="loan-term" class="form-control">
                                <option value="" disabled selected>-Select-</option>
                                <?php for ($i = 1; $i <= 60; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> months</option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="vehicle-price">Vehicle Price <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="vehicle-price" name="vehicle-price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="monthly-income">Monthly Income <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="monthly-income" name="monthly-income" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="desired-monthly-payment">Desired Monthly Payment <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="desired-monthly-payment" name="desired-monthly-payment" class="form-control">
                        </div>

                        <button type="submit" name="compute" class="btn btn-success">Compute</button>
                        <button type="reset" name="reset" class="btn btn-outline-success">Reset</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="resultbox" style="background-color: #ebfef2; border-radius: 20px;">
                    <h1 style="background-color: green;font-size:20px; font-weight: bold; color:#fff; border-top-left-radius: 20px; border-top-right-radius: 20px; padding:10px;">Result</h1>
                    <div class="row" style="padding:20px;">
                        <div class="col-md-4">
                        <div class="form-group md-fz">
                            <label for="amount">Amount:</label>
                            <input type="text" id="amount" name="amount" class="form-control" readonly>
                        </div>
                        </div>
                        <div class="col-md-4  md-fz">
                        <div class="form-group">
                            <label for="long-term">Long Term:</label>
                            <input type="text" id="long-term" name="long-term" class="form-control" readonly>
                        </div>
                        </div>
                        <div class="col-md-4  md-fz">
                        <div class="form-group">
                            <label for="annual-effective-interest-rate">Annual Effective Interest Rate:</label>
                            <input type="text" id="annual-effective-interest-rate" name="annual-effective-interest-rate" class="form-control" readonly>
                        </div>
                        </div>
                    </div>
                    <table class="table table-bordered mt-4 p-1">
                        <tbody>
                        <tr>
                            <td class="with-colors" style="border-top-left-radius: 20px;">Vehicle Price</td>
                            <td><input type="text" name="row1cell2" class="form-control" readonly></td>
                            <td><input type="text" name="row1cell3" class="form-control" readonly></td>
                            <td><input type="text" name="row1cell4" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td class="with-colors">Downpayment Percentage</td>
                            <td><input type="text" name="row2cell2" class="form-control" readonly></td>
                            <td><input type="text" name="row2cell3" class="form-control" readonly></td>
                            <td><input type="text" name="row2cell4" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td class="with-colors">Downpayment Amount</td>
                            <td><input type="text" name="row3cell2" class="form-control" readonly></td>
                            <td><input type="text" name="row3cell3" class="form-control" readonly></td>
                            <td><input type="text" name="row3cell4" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td class="with-colors">Loan Amount</td>
                            <td><input type="text" name="row4cell2" class="form-control" readonly></td>
                            <td><input type="text" name="row4cell3" class="form-control" readonly></td>
                            <td><input type="text" name="row4cell4" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td class="with-colors">Monthly Amortization</td>
                            <td><input type="text" name="row5cell2" class="form-control" readonly></td>
                            <td><input type="text" name="row5cell3" class="form-control" readonly></td>
                            <td><input type="text" name="row5cell4" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td class="with-colors" style="border-bottom-left-radius: 20px;">Total Amortization for the Loan Term</td>
                            <td><input type="text" name="row6cell2" class="form-control" readonly></td>
                            <td><input type="text" name="row6cell3" class="form-control" readonly></td>
                            <td><input type="text" name="row6cell4" class="form-control" readonly></td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- text -->

                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['compute'])) {
    $vehiclePrice = $_POST['vehicle-price'];
    $loanTerm = $_POST['loan-term'];
    $annualInterestRate = 12; // Assuming a fixed annual interest rate

    $downpaymentPercentages = [20, 30, 40];
    $downpaymentAmounts = [];
    $loanAmounts = [];
    $monthlyAmortizations = [];
    $totalAmortizations = [];

    foreach ($downpaymentPercentages as $percentage) {
        $downpaymentAmount = ($percentage / 100) * $vehiclePrice;
        $loanAmount = $vehiclePrice - $downpaymentAmount;
        $monthlyInterestRate = ($annualInterestRate / 100) / 12;
        $monthlyAmortization = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$loanTerm));
        $totalAmortization = $monthlyAmortization * $loanTerm;

        $downpaymentAmounts[] = $downpaymentAmount;
        $loanAmounts[] = number_format($loanAmount, 0, '.', ',');
        $monthlyAmortizations[] = number_format($monthlyAmortization, 0, '.', ',');
        $totalAmortizations[] = number_format($totalAmortization, 0, '.', ',');
    }

    echo "<script>
        document.getElementById('amount').value = '{$loanAmounts[0]}';
        document.getElementById('long-term').value = '$loanTerm months';
        document.getElementById('annual-effective-interest-rate').value = '$annualInterestRate%';
        document.querySelector('input[name=\"row1cell2\"]').value = '$vehiclePrice';
        document.querySelector('input[name=\"row2cell2\"]').value = '{$downpaymentPercentages[0]}%';
        document.querySelector('input[name=\"row3cell2\"]').value = '{$downpaymentAmounts[0]}';
        document.querySelector('input[name=\"row4cell2\"]').value = '{$loanAmounts[0]}';
        document.querySelector('input[name=\"row5cell2\"]').value = '{$monthlyAmortizations[0]}';
        document.querySelector('input[name=\"row6cell2\"]').value = '{$totalAmortizations[0]}';

        document.querySelector('input[name=\"row1cell3\"]').value = '$vehiclePrice';
        document.querySelector('input[name=\"row2cell3\"]').value = '{$downpaymentPercentages[1]}%';
        document.querySelector('input[name=\"row3cell3\"]').value = '{$downpaymentAmounts[1]}';
        document.querySelector('input[name=\"row4cell3\"]').value = '{$loanAmounts[1]}';
        document.querySelector('input[name=\"row5cell3\"]').value = '{$monthlyAmortizations[1]}';
        document.querySelector('input[name=\"row6cell3\"]').value = '{$totalAmortizations[1]}';

        document.querySelector('input[name=\"row1cell4\"]').value = '$vehiclePrice';
        document.querySelector('input[name=\"row2cell4\"]').value = '{$downpaymentPercentages[2]}%';
        document.querySelector('input[name=\"row3cell4\"]').value = '{$downpaymentAmounts[2]}';
        document.querySelector('input[name=\"row4cell4\"]').value = '{$loanAmounts[2]}';
        document.querySelector('input[name=\"row5cell4\"]').value = '{$monthlyAmortizations[2]}';
        document.querySelector('input[name=\"row6cell4\"]').value = '{$totalAmortizations[2]}';

        document.getElementById('vehicle-category').value = '{$_POST['vehicle-category']}';
        document.getElementById('loan-term').value = '$loanTerm';
        document.getElementById('vehicle-price').value = '$vehiclePrice';
        document.getElementById('monthly-income').value = '{$_POST['monthly-income']}';
        document.getElementById('desired-monthly-payment').value = '{$_POST['desired-monthly-payment']}';
    </script>";
     echo '<script>
      document.addEventListener("DOMContentLoaded", function() {
        var f = document.getElementById("loanForms");
        if (f) f.scrollIntoView({ behavior: "smooth" });
      });
    </script>';
} ?>
<script>
document.querySelector('button[name="reset"]').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('vehicle-category').selectedIndex = 0;
    document.getElementById('loan-term').selectedIndex = 0;
    document.getElementById('vehicle-price').value = '';
    document.getElementById('monthly-income').value = '';
    document.getElementById('desired-monthly-payment').value = '';
});
</script>
