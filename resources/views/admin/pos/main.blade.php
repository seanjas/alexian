@extends('admin.themes.layouts.main')

@section('title', 'POS - Receive')

@section('content')

<style>
    body {
        overflow-y: hidden;
    }

    .item-content {
        overflow-y: scroll !important;
    }

    .product-content {
        max-height: 400px;
        overflow-y: scroll !important;
    }

    .hover-box {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .hover-box:hover {
        transform: scale(1.05);
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }
</style>


<div class="content-header">
    
</div>

{{-- Main Content --}}
<div class="content">


</div>

<script>
    document.getElementById('cat_id').addEventListener('change', function() {
        let selectedCategory = this.value;
        let tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            let categoryCell = row.cells[3]; // The category is in the third cell
            let categoryValue = categoryCell.textContent.trim();

            if (selectedCategory === "" || categoryValue === selectedCategory) {
                row.style.display = ""; // Show row
            } else {
                row.style.display = "none"; // Hide row
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {

        updateGrandTotal();

        document.querySelectorAll('[id="po_prd_quantity"]').forEach(function(quantityInput) {
            quantityInput.addEventListener('input', function() {
                const price = parseFloat(this.dataset.price);
                const quantity = parseFloat(this.value);
                const totalAmount = price * quantity;

                const totalAmountField = this.closest('.row').querySelector('[id="po_total_amount"]');
                totalAmountField.value = totalAmount.toFixed(2);

                updateGrandTotal();
            });
        });
    });

    function updateGrandTotal() {
        let grandTotal = 0;
        let totalQuantity = 0;

        document.querySelectorAll('#po_total_amount').forEach(input => {
            grandTotal += parseFloat(input.value);
        });

        document.querySelectorAll('#po_prd_quantity').forEach(input => {
            totalQuantity += parseInt(input.value);
        });

        document.getElementById('grand_total').value = grandTotal.toFixed(2);
        document.getElementById('total_quantity').value = totalQuantity;
    }

    // $('#cat_id').on('change', function() {
    //     var selectedCategory = $(this).val();
    //     $('tbody tr').each(function() {
    //         var category = $(this).find('td:nth-child(3)').text().trim();
    //         if (selectedCategory === "" || category === selectedCategory) {
    //             $(this).show();
    //         } else {
    //             $(this).hide();
    //         }
    //     });
    // });

    // $(document).ready(function() {
    //     // Attach event listener to the plus button
    //     $('tbody').on('click', '.button-item-add', function(e) {
    //         e.preventDefault();  // Prevent page reload

    //         // Extract product details from the current row
    //         var $row = $(this).closest('tr');
    //         var sku = $row.find('td').eq(1).text();
    //         var name = $row.find('td').eq(2).text();
    //         var price = $row.find('input').eq(0).val();
    //         var quantity = $row.find('input').eq(1).val();

    //         // Create a new item element
    //         var newItem = `
    //             <div class="d-flex justify-content-between align-items-center my-2">
    //                 <div>
    //                     <strong>${name}</strong> (SKU: ${sku})
    //                     <br>
    //                     Quantity: ${quantity}, Price: ${price}
    //                 </div>
    //                 <button class="btn btn-danger btn-sm remove-item"><i class="fa-solid fa-trash"></i></button>
    //             </div>
    //         `;

    //         // Append the new item to the .item-content div
    //         $('.item-content').append(newItem);

    //         // Optionally, you can remove the "No item Selected" text if there's any item added
    //         $('.item-content p').remove();
    //     });

    //     // Remove item when trash button is clicked
    //     $('.item-content').on('click', '.remove-item', function(e) {
    //         $(this).closest('div').remove();

    //         // If no items are left, display "No item Selected"
    //         if ($('.item-content').children().length === 0) {
    //             $('.item-content').html('<p class="text-center">No item Selected</p>');
    //         }
    //     });
    // });

    // $(document).ready(function() {
    //     // Attach event listener to the plus button
    //     $('tbody').on('click', '.button-item-add', function(e) {
    //         e.preventDefault();  // Prevent default button action

    //         // Find the form within the same row as the clicked button
    //         var $form = $(this).closest('tr').find('form');

    //         // Submit the form
    //         $form.submit();
    //     });
    // });
</script>

@endsection
