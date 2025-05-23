<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
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
                    <h1 style="font-size: 20px; font-weight: bold; color:#fff; padding: 10px; background-color:green; border-top-left-radius: 20px; border-top-right-radius: 20px;">Loan Calculator</h1>
                    <div class="spacing">
                        <div class="form-group">
                            <label for="loan-amount">Loan Amount <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="loan-amount" name="loan-amount" class="form-control" value="<?php echo htmlspecialchars($loanAmount ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="loan-term">Loan Term (in months) <i class="fas fa-exclamation-circle"></i></label>
                            <select id="loan-term" name="loan-term" class="form-control">
                                <option>-Select-</option>
                                <?php 
                                $terms = [12, 18, 24, 36, 48, 60];
                                foreach ($terms as $term): ?>
                                    <option value="<?php echo htmlspecialchars($term, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($term, ENT_QUOTES, 'UTF-8'); ?> months</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group d-none">
                            <label for="interest-rate">Interest Rate <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="interest-rate" name="interest-rate" class="form-control" value="12%" readonly>
                            <input type="hidden" name="rate-in-decimal" value="<?php echo htmlspecialchars(get_field('rate_in_decimal') ?: '1.27', ENT_QUOTES, 'UTF-8'); ?>" readonly>
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
function calculatePMT($loanAmount, $annualInterestRate, $loanTerm) {
    $monthlyRate = $annualInterestRate / 12 / 100;
    $n = $loanTerm;
    $pmt = $loanAmount * ($monthlyRate * pow(1 + $monthlyRate, $n)) / (pow(1 + $monthlyRate, $n) - 1);
    return round($pmt, 2);
}

if (isset($_POST['compute'])) {
    $loanAmount = htmlspecialchars($_POST['loan-amount']);
    $loanTerm = htmlspecialchars($_POST['loan-term']);
    $annualInterestRate = htmlspecialchars($_POST['interest-rate']);

    $totalInterest = $loanAmount * ($loanTerm * ($annualInterestRate / 100));
    $monthlyAmortization = calculatePMT($loanAmount, 12, $loanTerm);
    echo "<script>
        document.getElementById('loan-amount').value = '". htmlspecialchars(number_format($loanAmount, 2, '.', ','), ENT_QUOTES, 'UTF-8') . "';
        document.getElementById('loan-term').value = '". htmlspecialchars($loanTerm, ENT_QUOTES, 'UTF-8') . "';
        document.getElementById('interest-rate').value = '". htmlspecialchars($annualInterestRate, ENT_QUOTES, 'UTF-8') . "';
        document.getElementById('amount').value = '". htmlspecialchars(number_format($loanAmount, 2, '.', ','), ENT_QUOTES, 'UTF-8') . "';
        document.getElementById('long-term').value = '". htmlspecialchars($loanTerm . ' months', ENT_QUOTES, 'UTF-8') . "';
        document.getElementById('monthly-amortization').value = '". htmlspecialchars(number_format($monthlyAmortization, 2, '.', ','), ENT_QUOTES, 'UTF-8') . "';
    </script>";
    echo '<script>
      document.addEventListener("DOMContentLoaded", function() {
        var f = document.getElementById("loanForms");
        if (f) f.scrollIntoView({ behavior: "smooth" });
      });
    </script>';
}
?>

<script>
document.querySelector('button[name="reset"]').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('loan-amount').value = '';
    document.getElementById('loan-term').selectedIndex = 0;
    document.getElementById('interest-rate').value = '';
    document.getElementById('amount').value = '';
    document.getElementById('long-term').value = '';
    document.getElementById('monthly-amortization').value = '';
});
</script>
