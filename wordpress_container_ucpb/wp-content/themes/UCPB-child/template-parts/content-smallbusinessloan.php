<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .with-colors { background-color: green; color: #fff; border: none !important; }
    .spacing { padding: 20px; }
    .md-fz { font-size: 14px; }
    .form-control { border: 1px solid green; }
    .form-control[readonly] { background: #fff; }
</style>

<div class="loan-calculator mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form id="loanForms" action="" method="post" class="form-group" style="background-color: #ebfef2;">
                    <h1 style="font-size: 20px; font-weight: bold; color:#fff; padding: 10px; background-color:green; border-top-left-radius: 20px; border-top-right-radius: 20px;">Loan Calculator</h1>
                    <div class="spacing">
                        <div class="form-group">
                            <label for="loan-amount">Loan Amount <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="loan-amount" name="loan-amount" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="loan-years">Loan Term (in years) <i class="fas fa-exclamation-circle"></i></label>
                            <select id="loan-years" name="loan-years" class="form-control">
                                <option>-Select-</option>
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> years</option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="business-industry">Business Industry</label>
                            <select id="business-industry" name="business-industry" class="form-control">
                                <option>-Select-</option>
                                <option value="sbl-agri">SBL Agri</option>
                                <option value="sbl">SBL</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="loan-purpose">Loan Purpose</label>
                            <select id="loan-purpose" name="loan-purpose" class="form-control">
                                <option>-Select-</option>
                                <?php 
                                $terms = ['Home Improvement', 'Medical Expenses', 'Car Maintenance', 'Funeral Expenses', 'Investing in Gadgets', 'Additional Working capital', 'Land Acquisition', 'Others'];
                                foreach($terms as $term): ?>
                                    <option value="<?php echo htmlspecialchars($term, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($term, ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group d-none">
                            <label for="interest-rate">Interest Rate <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="interest-rate" name="interest-rate" class="form-control" value="<?php echo htmlspecialchars(get_field('rate') ?: '9.50%', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                            <input type="hidden" id="rate-in-decimal" name="rate-in-decimal" value="<?php echo htmlspecialchars(get_field('rate_in_decimal') ?: '9.50', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>

                        <button type="submit" name="compute" class="btn btn-success">Compute</button>
                        <button type="reset" name="reset" class="btn btn-outline-success">Reset</button>
                    </div>
                </form>
            </div>

            <div class="col-md-8">
                <div class="resultbox" style="background-color: #ebfef2; border-radius: 20px;">
                    <h1 style="background-color: green; font-size: 20px; font-weight: bold; color: #fff; border-top-left-radius: 20px; border-top-right-radius: 20px; padding: 10px;">Result</h1>
                    <div class="row" style="padding:20px;">
                        <div class="col-md-12">
                            <div class="form-group md-fz">
                                <label for="amount">Loan Amount:</label>
                                <input type="text" id="amount" name="amount" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-12 md-fz">
                            <div class="form-group">
                                <label for="long-term">Loan Term (in months):</label>
                                <input type="text" id="long-term" name="long-term" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-12 md-fz">
                            <div class="form-group">
                                <label for="monthly-amortization">Monthly Amortization:</label>
                                <input type="text" id="monthly-amortization" name="monthly-amortization" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const industryType = document.getElementById('business-industry');
    const interestRateField = document.getElementById('interest-rate');
    const rateDecimalField = document.getElementById('rate-in-decimal');

    industryType.addEventListener('change', function() {
        let rate = 0;

        if (this.value === 'sbl-agri') {
            rate = <?= json_encode(!empty(get_field('for_sbl_agri')) ? get_field('for_sbl_agri') : 9.75); ?>;
        } else if (this.value === 'sbl') {
            rate = <?= json_encode(!empty(get_field('for_sbl')) ? get_field('for_sbl') : 10.00); ?>;;
        }

        if (rate > 0) {
            interestRateField.value = rate.toFixed(2) + '%';
            rateDecimalField.value = rate.toFixed(2);
        } else {
            interestRateField.value = '';
            rateDecimalField.value = '';
        }
    });

    document.querySelector('button[name="reset"]').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('loan-amount').value = '';
        document.getElementById('loan-years').selectedIndex = 0;
        document.getElementById('business-industry').selectedIndex = 0;
        document.getElementById('loan-purpose').selectedIndex = 0;
        document.getElementById('interest-rate').value = '';
        document.getElementById('rate-in-decimal').value = '';
        document.getElementById('amount').value = '';
        document.getElementById('long-term').value = '';
        document.getElementById('monthly-amortization').value = '';
    });
});
</script>

<?php
if (isset($_POST['compute'])) {
    $loanAmount = isset($_POST['loan-amount']) ? floatval(str_replace(',', '', $_POST['loan-amount'])) : 0;
    $loanTermYears = isset($_POST['loan-years']) ? intval($_POST['loan-years']) : 0;
    $businessType = htmlspecialchars($_POST['business-industry'] ?? '', ENT_QUOTES, 'UTF-8');
    $loanPurpose = htmlspecialchars($_POST['loan-purpose'] ?? '', ENT_QUOTES, 'UTF-8');
    $annualInterestRate = isset($_POST['rate-in-decimal']) ? floatval($_POST['rate-in-decimal']) : 9.5;

    $loanTermMonths = $loanTermYears * 12;
    $monthlyInterestRate = ($annualInterestRate / 100) / 12;

    $monthlyAmortization = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$loanTermMonths));

    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('loan-amount').value = '" . number_format($loanAmount, 2, '.', ',') . "';
        document.getElementById('loan-years').value = '" . $loanTermYears . "';
        document.getElementById('business-industry').value = '" . $businessType . "';
        document.getElementById('loan-purpose').value = '" . $loanPurpose . "';
        document.getElementById('interest-rate').value = '" . number_format($annualInterestRate, 2) . "%';
        document.getElementById('rate-in-decimal').value = '" . number_format($annualInterestRate, 2) . "';

        document.getElementById('amount').value = '" . number_format($loanAmount, 2, '.', ',') . "';
        document.getElementById('long-term').value = '" . $loanTermMonths . " months';
        document.getElementById('monthly-amortization').value = '" . number_format($monthlyAmortization, 2, '.', ',') . "';
        
        var form = document.getElementById('loanForms');
        if (form) form.scrollIntoView({ behavior: 'smooth' });
    });
    </script>";
}
?>
