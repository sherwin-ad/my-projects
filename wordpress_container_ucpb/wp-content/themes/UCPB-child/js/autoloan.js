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
                rate = 6.42;
            } else if (selectedValue === 18) {
                rate = 8.98;
            } else if (selectedValue === 24) {
                rate = 11.58;
            } else if (selectedValue === 36) {
                rate = 17.33;
            } else if (selectedValue === 48) {
                rate = 24.13;
            } else if (selectedValue === 60) {
                rate = 31.76;
            }

            // Set the display value with % sign
            addonRate.value = rate.toFixed(2) + '%';
            // Set the actual value without % sign for form submission
            addonRate.setAttribute('value', rate.toFixed(2));
            // rateInDecimal.setAttribte('vale', rate.toFixed(2))
            rateInDecimal.value = rate.toFixed(2);
        } else {
            
            if (selectedValue === 12) {
                rate = 6.56;
            } else if (selectedValue === 18) {
                rate = 9.19;
            } else if (selectedValue === 24) {
                rate = 12.98;
            } else if (selectedValue === 36) {
                rate = 19.91;
            } else if (selectedValue === 48) {
                rate = 27.67;
            } else if (selectedValue === 60) {
                rate = 36.34;
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