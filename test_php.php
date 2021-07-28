<script>
// функция должна возвращать "Залог: ПАРТНЁР, ИНН: ХХХХХХХХ" или "Лизинг: ПАРТНЁР, ИНН: ХХХХХХХХ" в зависимости от atr_rqs_type_bank_lease
function prepareLease(input) {
    if (input.body.offerData.atr_rqs_bank_lease) {
        if (input.body.offerData.atr_rqs_type_bank_lease) {
            if (input.body.offerData.atr_rqs_type_bank_lease == "atr_rqs_type_bank_lease_1") {
                bank_lease = "Залог: ";
                if (input.body.offerData.atr_rqs_bank_leasing_partner) {
                    bank_lease += input.body.beneficiary.atr_rqs_bank_leasing_partner;
                }
            } else if (input.body.offerData.atr_rqs_type_bank_lease == "atr_rqs_type_bank_lease_2") {
                bank_lease = "Лизинг: ";
                if (input.body.offerData.atr_rqs_bank_leasing_partner) {
                    bank_lease += input.body.beneficiary.atr_rqs_bank_leasing_partner;
                }
            }
        }
    }
    return bank_lease;
}

// Исправить ошибки в коде. JSON с объектом input приведен ниже.
// Провести рефакторинг: Создать константы, убрать дубли.

JSON
{
    "body": {
        "beneficiary": {
            "beneficiaryPolicyHolder": true,
            "commonData": {
                "partyId": "0000000000",
                "partyCode": "5",
                "partyType": "NaturalPerson",
                "fullName": "FirstName LastName",
                "firstName": "FirstName",
                "lastName": "LastName",
                "taxNumber": "111111111",
                "resident": true
            }
        },
        "mainPolicyData": {
            "startDate": "2021-05-04",
            "endDate": "2022-05-03"
        },
        "offerData": {
            "atr_rqs_loss_system": "atr_rqs_loss_system_1",
            "atr_rqs_procedure_for_establishing": "atr_rqs_procedure_for_establishing_1",
            "currency": "RUB",
            "atr_rqs_cover_general_deductible_currency": 10000,
            "atr_rqs_general_rules_of_policy": "atr_rqs_general_rules_of_policy_1",
            "atr_rqs_locations_number": 1,
            "atr_rqs_cover_type": "atr_ins_cover_type_2",
            "atr_rqs_cover_general_deductible_amount": true,
            "atr_rqs_cover_general_deductible_percentage": false,
            "atr_rqs_cover_general_deductible": false,
            "atr_rqs_elements_estate_property": "atr_obj_elements_estate_property_3",
            "atr_rqs_average_si_locations": 550000,
            "atr_rqs_general_si_locations": 1100000,
            "atr_rqs_si_locations_cumul": 1000000,
            "atr_rqs_objects_without_fundation": false,
            "atr_rqs_special_locations": false,
            "atr_rqs_special_locations_ratio": 0,
            "atr_rqs_fire_systems": "не требуется",
            "atr_rqs_risk_occupation": "Торговля автомобилями в торговом зале",
            "atr_rqs_risk_code": "9010",
            "atr_rqs_risk_class": "C",
            "atr_rqs_risk_industry": "Сфера торговли",
            "atr_rqs_business_category": "непромышленный",
            "atr_rqs_risk_segment": "целевой",
            "atr_rqs_territory_max_location_index": 0,
            "atr_rqs_max_si_location": 1000000,
            "atr_rqs_territory_max_location": "1",
            "atr_rqs_premises_elements_estate_property": "atr_obj_premises_elements_estate_property_2",
            "atr_rqs_type_bank_lease": "atr_rqs_type_bank_lease_1",
            "atr_rqs_bank_leasing_partner": "ВТБ",
            "atr_rqs_bank_leasing_partner_INN": "770770770700700",
            "atr_rqs_insurance_value": 10000000,
            "atr_rqs_losses": "atr_rqs_losses_1",
            "atr_rqs_number_of_losses_5years": "No",
            "atr_rqs_bank_lease": true,
            "atr_rqs_losses_without_amortization": true,
            "atr_rqs_max_cumul_PML_sum": 0
        },
        "durationPeriods": [
            {
                "periodStartDate": "2021-05-04",
                "periodEndDate": "2022-05-04"
            }
        ],
        "startDate": "2021-05-04",
        "endDate": "2022-05-03",
        "policyDuration": "1 г.",
        "policyDurationYears": 1,
        "policyDurationMonths": 0,
        "policyDurationDays": 0,
        "tariffAttributes": {
            "atr_tariff_loading_percentage": 0,
            "atr_tariff_general_loading_percentage": 0
        },
        "partners": []
    }
}

</script>
