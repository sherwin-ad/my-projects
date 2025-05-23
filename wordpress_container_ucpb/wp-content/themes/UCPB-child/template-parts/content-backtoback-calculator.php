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
    .form-group {
        background-color: #ebfef2;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
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
                            <input type="text" id="loan-amount" name="loan-amount" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="loan-term">Loan Term (in months) <i class="fas fa-exclamation-circle"></i></label>
                            <select id="loan-term" name="loan-term" class="form-control">
                                <?php for ($i = 12; $i <= 60; $i += 12): ?>
                                    <option value="<?php echo htmlspecialchars($i); ?>"><?php echo htmlspecialchars($i); ?> months</option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="interest-rate">Interest Rate <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="interest-rate" name="interest-rate" class="form-control" value="<?php echo htmlspecialchars(get_field('rate') ?: '1.27%'); ?>" readonly>
                            <input type="hidden" name="rate-in-decimal" value="<?php echo htmlspecialchars(get_field('rate_in_decimal') ?: '1.27'); ?>" readonly>
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
                                <label for="monthly-amortization">Amount to Pay:</label>
                                <input type="text" id="amount-pay" name="monthly-amortization" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['compute'])) {
    // Sanitize inputs
    $loanAmount = htmlspecialchars($_POST['loan-amount']);
    $loanTerm = htmlspecialchars($_POST['loan-term']);
    $interestRate = htmlspecialchars($_POST['rate-in-decimal']); // Fixed annual interest rate

    // Compute the total amount
    $totalAmount = $loanAmount * $interestRate * $loanTerm;
    $amountdecimal = number_format($totalAmount, 2, '.', ',');

    // Safe insertion of sanitized data into JavaScript
    echo "<script>
        document.getElementById('loan-amount').value = " . json_encode($loanAmount) . ";
        document.getElementById('loan-term').value = " . json_encode($loanTerm) . ";
        document.getElementById('amount').value = " . json_encode(number_format($loanAmount, 2, '.', ',')) . ";
        document.getElementById('long-term').value = " . json_encode("$loanTerm months") . ";
        document.getElementById('amount-pay').value = " . json_encode($amountdecimal) . ";
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
    document.getElementById('amount').value = '';
    document.getElementById('long-term').value = '';
    document.getElementById('amount-pay').value = '';
});
</script>
