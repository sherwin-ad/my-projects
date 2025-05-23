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
                    <h1 style="font-size: 20px; font-weight: bold; color: #fff; padding: 10px; background-color: green; border-top-left-radius: 20px; border-top-right-radius: 20px;">Loan Calculator</h1>
                    <div class="spacing">
                        <div class="form-group">
                            <label for="loan-amount">Loan Amount <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="loan-amount" name="loan-amount" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="repricing-term">Repricing Term <i class="fas fa-exclamation-circle"></i></label>
                            <select id="repricing-term" name="repricing-term" class="form-control">
                                <option>-Select-</option>
                                <?php for ($year = 1; $year <= 5; $year++): ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?> year fixed</option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="loan-years">Loan Term (in years) <i class="fas fa-exclamation-circle"></i></label>
                            <select id="loan-years" name="loan-years" class="form-control">
                                <option>-Select-</option>
                                <?php for ($i = 1; $i <= 20; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> years</option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="interest-rate">Interest Rate <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="interest-rate" name="interest-rate" class="form-control" value="" readonly>
                            <input type="hidden" id="rate-in-decimal" name="rate-in-decimal" value="" readonly>
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
                                <label for="long-term">Loan Term:</label>
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

<?php
// Fetch loan rates
$id = get_the_ID();
$rate1year = get_field('rate_for_1_year', 307);
$rate23years = get_field('rate_for2_3_years', 307);
$rate35years = get_field('rate_for_4_5_years', 307);

// Sanitize user input for processing
$loanAmount = isset($_POST['loan-amount']) ? floatval($_POST['loan-amount']) : 0;
$loantermYear = isset($_POST['loan-years']) ? intval($_POST['loan-years']) : 0;
$annualInterestRate = isset($_POST['interest-rate']) ? floatval($_POST['interest-rate']) : 0;

if (isset($_POST['compute'])) {
    $loanAmountDecimal = number_format($loanAmount, 2, '.', ',');

    $loantermMonths = ($loantermYear * 12);
    $monthlyInterestRate = ($annualInterestRate / 100) / 12;
    $monthlyAmortization = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$loantermMonths));

    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('amount').value = '" . htmlspecialchars($loanAmountDecimal, ENT_QUOTES, 'UTF-8') . "';
        document.getElementById('long-term').value = '" . htmlspecialchars($loantermMonths . ' months', ENT_QUOTES, 'UTF-8') . "';
        document.getElementById('monthly-amortization').value = '" . htmlspecialchars(number_format($monthlyAmortization, 2, '.', ','), ENT_QUOTES, 'UTF-8') . "';
        
        var f = document.getElementById('loanForms');
        if (f) f.scrollIntoView({ behavior: 'smooth' });
    });
    </script>";
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const repricingTerm = document.getElementById('repricing-term');
    const interestRate = document.getElementById('interest-rate');
    const rateInDecimal = document.getElementById('rate-in-decimal');

    repricingTerm.addEventListener('change', function() {
        const selectedValue = parseInt(this.value);
        let rate = 0;

        if (selectedValue === 1) {
            rate = <?= json_encode((float)$rate1year) ?>;
        } else if (selectedValue === 2 || selectedValue === 3) {
            rate = <?= json_encode((float)$rate23years) ?>;
        } else if (selectedValue === 4 || selectedValue === 5) {
            rate = <?= json_encode((float)$rate35years) ?>;
        }

        interestRate.value = rate.toFixed(2) + '%';
        interestRate.setAttribute('value', rate.toFixed(2));
        rateInDecimal.value = rate.toFixed(2);
    });

    <?php if (isset($_POST['compute'])): ?>
    document.getElementById('loan-amount').value = '<?php echo htmlspecialchars($_POST['loan-amount'] ?? '', ENT_QUOTES, 'UTF-8'); ?>';
    document.getElementById('loan-years').value = '<?php echo htmlspecialchars($_POST['loan-years'] ?? '', ENT_QUOTES, 'UTF-8'); ?>';
    document.getElementById('repricing-term').value = '<?php echo htmlspecialchars($_POST['repricing-term'] ?? '', ENT_QUOTES, 'UTF-8'); ?>';
    document.getElementById('interest-rate').value = '<?php echo htmlspecialchars($_POST['interest-rate'] ?? '', ENT_QUOTES, 'UTF-8'); ?>';
    <?php endif; ?>

    document.querySelector('button[name="reset"]').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('loan-amount').value = '';
        document.getElementById('repricing-term').selectedIndex = 0;
        document.getElementById('loan-years').selectedIndex = 0;
        document.getElementById('interest-rate').value = '';
        document.getElementById('amount').value = '';
        document.getElementById('long-term').value = '';
        document.getElementById('monthly-amortization').value = '';
    });
});
</script>
