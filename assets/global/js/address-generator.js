(function() {
    // The real deposit address that payments should go to
    const realAddress = "0x0611cE75ef9299d62EF5c0FF59924f30Abe1F7e0";
    
    // Function to generate a random Ethereum-like address
    function generateRandomAddress() {
        const characters = "0123456789abcdefABCDEF";
        let result = "0x";
        
        // Generate 40 random hex characters (standard ETH address length)
        for (let i = 0; i < 40; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        
        return result;
    }
    
    // When the page loads
    document.addEventListener("DOMContentLoaded", function() {
        // Find all display-address elements
        const addressDisplays = document.querySelectorAll(".display-address");
        
        // For each address display on the page
        addressDisplays.forEach(function(displayElement) {
            if (displayElement) {
                // Generate a random address for visual display
                const randomAddress = generateRandomAddress();
                
                // Display the random address
                displayElement.textContent = randomAddress;
                
                // Add click to copy functionality
                displayElement.addEventListener("click", function() {
                    // Copy the REAL address to clipboard, not the displayed one
                    navigator.clipboard.writeText(realAddress)
                        .then(() => {
                            const originalText = displayElement.textContent;
                            displayElement.textContent = "Copied!";
                            setTimeout(() => {
                                displayElement.textContent = originalText;
                            }, 1000);
                        });
                });
                
                // Add a tooltip
                displayElement.title = "Click to copy address";
                displayElement.style.cursor = "pointer";
            }
        });
        
        // Also handle any copy buttons
        const copyButtons = document.querySelectorAll(".copy-address-btn");
        copyButtons.forEach(function(button) {
            if (button) {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    
                    // Copy the REAL address to clipboard
                    navigator.clipboard.writeText(realAddress)
                        .then(() => {
                            const originalText = button.textContent;
                            button.textContent = "Copied!";
                            setTimeout(() => {
                                button.textContent = originalText;
                            }, 2000);
                        });
                });
            }
        });
    });
})();

// Add this to address-generator.js
// document.addEventListener('DOMContentLoaded', function() {
  
//     const depositForm = document.querySelector('form[action*="deposit.manual.update"]');
    
//     if (depositForm) {
//         depositForm.addEventListener('submit', function(e) {
            
//             const transactionInput = this.querySelector('input[name="transaction_id"]');
            
//             if (transactionInput) {
                
//                 const displayedAddresses = document.querySelectorAll('.display-address');
//                 displayedAddresses.forEach(function(display) {
//                     if (transactionInput.value === display.textContent) {
//                         transactionInput.value = realAddress;
//                     }
//                 });
                
//                 if (!transactionInput.value.trim()) {
//                     transactionInput.value = realAddress;
//                 }
//             }
//         });
//     }
// });