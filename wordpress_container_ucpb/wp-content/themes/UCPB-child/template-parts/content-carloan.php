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
                
                <form id="loanForms" action="" method="POST" class="form-group" style="background-color: #ebfef2;">
                    <h1 style="font-size: 20px; font-weight: bold; color:#fff; padding: 10px; background-color:green; border-top-left-radius: 20px; border-top-right-radius: 20px;">Loan Calculator</h1>
                    <div class="spacing">
                        <div class="form-group">
                            <label for="brand-new">Borrower Type <i class="fas fa-exclamation-circle"></i></label>
                            <select id="brand-new" name="brand-new" class="form-control">
                                <option value="rb">Repeat Borrower/Depositor</option>
                                <option value="nd">Non Depositor</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="tcp">TCP <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="tcp" name="tcp" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="discount">Discount <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="discount" name="discount" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="net-price">Net Price <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="net-price" name="net-price" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="downpayment">Downpayment (%) <i class="fas fa-exclamation-circle"></i></label>
                            <select id="downpayment" name="downpayment" class="form-control">
                                <option value="20">20%</option>
                                <option value="30">30%</option>
                                <option value="40">40%</option>
                                <option value="50">50%</option>
                                <option value="60">60%</option>
                                <option value="80">80%</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="loan-term">Loan Term (in months) <i class="fas fa-exclamation-circle"></i></label>
                            <select id="loan-term" name="loan-term" class="form-control">
                                <?php
                                    $months = [12, 18, 24, 36, 48, 60];
                                    foreach ($months as $i): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> months</option>
                                    <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="add-on-rate">Add-on Rate <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="add-on-rate" name="add-on-rate" class="form-control" value="30.26%" readonly>
                        </div>

                        <div class="form-group d-none">
                            <label for="interest-rate">Interest Rate <i class="fas fa-exclamation-circle"></i></label>
                            <input type="text" id="interest-rate" name="interest-rate" class="form-control" value="<?php echo get_field('rate') ?: '10.935%'; ?>" readonly>
                            <input type="hidden" name="rate-in-decimal" value="<?php echo get_field('rate_in_decimal') ?: '10.935'; ?>" readonly>
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
                                <label for="principal-amount">Principal Amount:</label>
                                <input type="text" id="principal-amount" name="principal-amount" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 md-fz">
                            <div class="form-group">
                                <label for="downpayment-total">Downpayment Total:</label>
                                <input type="text" id="downpayment-total" name="downpayment-total" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 md-fz">
                            <div class="form-group">
                                <label for="monthly-amortization">Monthly Amortization:</label>
                                <input type="text" id="monthly-amortization" name="monthly-amortization" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 md-fz">
                            <div class="form-group">
                                <label for="terms-month">Terms (Months):</label>
                                <input type="text" id="terms-month" name="terms-month" class="form-control" readonly>
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
    const repricingTerm = document.getElementById('loan-term');
    const addonRate = document.getElementById('add-on-rate');
    // const rateInDecimal = document.getElementById('rate-in-decimal');
    const consumer = document.getElementById('brand-new');

    let consumerValue = consumer.value;

    // Update consumer value when it changes
    consumer.addEventListener('change', function() {
        consumerValue = this.value;
    });

    repricingTerm.addEventListener('change', function() {
        const selectedValue = parseInt(this.value);
        let rate = 0;
        console.log(consumerValue);

        if (consumerValue === 'rb') {
            // Only apply these rates if consumer is 'rb'
            if (selectedValue === 12) {
                rate = <?= json_encode(!empty(get_field('for_12_rb')) ? get_field('for_12_rb') : 6.42); ?>;
            } else if (selectedValue === 18) {
                rate = <?= json_encode(!empty(get_field('for_18_rb')) ? get_field('for_18_rb') : 8.98); ?>;
            } else if (selectedValue === 24) {
                rate = <?= json_encode(!empty(get_field('for_24_rb')) ? get_field('for_24_rb') : 11.58); ?>;
            } else if (selectedValue === 36) {
                rate = <?= json_encode(!empty(get_field('for_36_rb')) ? get_field('for_36_rb') : 17.33); ?>;
            } else if (selectedValue === 48) {
                rate = <?= json_encode(!empty(get_field('for_48_rb')) ? get_field('for_48_rb') : 24.13); ?>;
            } else if (selectedValue === 60) {
                rate = <?= json_encode(!empty(get_field('for_60_rb')) ? get_field('for_60_rb') : 31.76); ?>;
            }

            // Set the display value with % sign
            addonRate.value = rate.toFixed(2) + '%';
            // Set the actual value without % sign for form submission
            addonRate.setAttribute('value', rate.toFixed(2));
            // rateInDecimal.setAttribte('vale', rate.toFixed(2))
            rateInDecimal.value = rate.toFixed(2);
        } else {
            
            if (selectedValue === 12) {
                rate = <?= json_encode(!empty(get_field('for_12')) ? get_field('for_12') : 6.56); ?>;
            } else if (selectedValue === 18) {
                rate = <?= json_encode(!empty(get_field('for_18')) ? get_field('for_18') : 9.19); ?>;
            } else if (selectedValue === 24) {
                rate = <?= json_encode(!empty(get_field('for_24')) ? get_field('for_24') : 12.98); ?>;
            } else if (selectedValue === 36) {
                rate = <?= json_encode(!empty(get_field('for_36')) ? get_field('for_36') : 19.91); ?>;
            } else if (selectedValue === 48) {
                rate = <?= json_encode(!empty(get_field('for_48')) ? get_field('for_48') : 27.67); ?>;
            } else if (selectedValue === 60) {
                rate = <?= json_encode(!empty(get_field('for_60')) ? get_field('for_60') : 36.34); ?>;
            }
            // Set the display value with % sign
            addonRate.value = rate.toFixed(2) + '%';
            // Set the actual value without % sign for form submission
            addonRate.setAttribute('value', rate.toFixed(2));
            // rateInDecimal.setAttribte('vale', rate.toFixed(2))
            rateInDecimal.value = rate.toFixed(2);
        }

        
    });
});
</script>
<script>
document.getElementById('tcp').addEventListener('input', calculateNetPrice);
document.getElementById('discount').addEventListener('input', calculateNetPrice);
document.getElementById('downpayment').addEventListener('change', calculatePrincipalAmount);
function calculateNetPrice() {
    var tcp = parseFloat(document.getElementById('tcp').value) || 0;
    var discount = parseFloat(document.getElementById('discount').value) || 0;
    var netPrice = tcp - discount;
    document.getElementById('net-price').value = netPrice.toFixed(2);
    calculatePrincipalAmount();
}

function calculatePrincipalAmount() {
    var netPrice = parseFloat(document.getElementById('net-price').value) || 0;
    var downpaymentPercentage = parseFloat(document.getElementById('downpayment').value) || 0;
    var downpaymentAmount = netPrice * (downpaymentPercentage / 100);
    var principalAmount = netPrice - downpaymentAmount;
    document.getElementById('principal-amount').value = principalAmount.toFixed(2);
}
</script>
<?php
function computeMonthlyAmortization($loanAmount, $loanTerm, $annualInterestRate) {
    $monthlyInterestRate = $annualInterestRate / 12 / 100;
    $monthlyAmortization = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$loanTerm));
    return number_format($monthlyAmortization, 2, '.', '');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compute'])) {
    $tcp = filter_input(INPUT_POST, 'tcp', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $discount = filter_input(INPUT_POST, 'discount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $downpaymentPercentage = filter_input(INPUT_POST, 'downpayment', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $loanTerm = filter_input(INPUT_POST, 'loan-term', FILTER_SANITIZE_NUMBER_INT);
    $annualInterestRate = filter_input(INPUT_POST, 'rate-in-decimal', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $tcp = floatval($tcp);
    $discount = floatval($discount);
    $downpaymentPercentage = floatval($downpaymentPercentage);
    $loanTerm = intval($loanTerm);
    $annualInterestRate = floatval($annualInterestRate);

    $netPrice = $tcp - $discount;
    $downpaymentAmount = $netPrice * ($downpaymentPercentage / 100);
    $loanAmount = $netPrice - $downpaymentAmount;

    $monthlyAmortization = computeMonthlyAmortization($loanAmount, $loanTerm, $annualInterestRate);

    echo "<script>
    document.getElementById('net-price').value = " . json_encode(number_format($netPrice, 2, '.', ',')) . ";
    document.getElementById('principal-amount').value = " . json_encode(number_format($loanAmount, 2, '.', ',')) . ";
    document.getElementById('downpayment-total').value = " . json_encode(number_format($downpaymentAmount, 2, '.', ',')) . ";
    document.getElementById('terms-month').value = " . json_encode($loanTerm . ' months') . ";
    document.getElementById('monthly-amortization').value = " . json_encode(number_format($monthlyAmortization, 2, '.', ',')) . ";
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
document.addEventListener('DOMContentLoaded', function() {
    if (<?php echo isset($_POST['compute']) ? 'true' : 'false'; ?>) {
        document.getElementById('tcp').value = '<?php echo htmlspecialchars($_POST['tcp'] ?? '', ENT_QUOTES, 'UTF-8'); ?>';
        document.getElementById('discount').value = '<?php echo htmlspecialchars($_POST['discount'] ?? '', ENT_QUOTES, 'UTF-8'); ?>';
        document.getElementById('interest-rate').value = '<?php echo htmlspecialchars($_POST['add-on-rate'] ?? '', ENT_QUOTES, 'UTF-8'); ?>';
        document.getElementById('downpayment').value = '<?php echo htmlspecialchars($_POST['downpayment'] ?? '', ENT_QUOTES, 'UTF-8'); ?>';
        document.getElementById('loan-term').value = '<?php echo htmlspecialchars($_POST['loan-term'] ?? '', ENT_QUOTES, 'UTF-8'); ?>';
    }
});
</script>

<script>
document.querySelector('button[name="reset"]').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('tcp').value = '';
    document.getElementById('discount').value = '';
    document.getElementById('net-price').value = '';
    document.getElementById('downpayment').selectedIndex = 0;
    document.getElementById('loan-term').selectedIndex = 0;
    document.getElementById('add-on-rate').value = '30.26%';
    // document.getElementById('interest-rate').value = '10.9350%';
    document.getElementById('principal-amount').value = '';
    document.getElementById('downpayment-total').value = '';
    document.getElementById('monthly-amortization').value = '';
    document.getElementById('terms-month').value = '';
});
</script>
