## Parapharmacy 
> Progetto corso di Web Programming a.a. 2020-2021

## Specifiche di progetto

Si vuole realizzare un sito web per la gestione di svariate parafarmacie.

Con il Mini-Homework 1 si implementa:

  - Visionare le parafarmacie sotto la propria gestione. Visionare i prodotti trattati dalle parafarmacie. Visionare i clienti delle parafarmacie.
  - Accedere al supporto della WebApp.
  - Ottenere info su un medicinale indicato dall’utente.
  - Cercare un farmacista secondo dei parametri inseriti dall’utente.
  - Aggiungere un prodotto al database mediante i parametri inseriti dall’utente. Ottenere il numero dei farmacisti di una parafarmacia indicata dall’utente.


Con il Mini-Homework 2 si implementa:

  - Una sezione “preferiti”, all’interno della quale l’utente può inserire un sottoinsieme dei contenuti visualizzati.
  - Una barra di ricerca, tramite la quale l’utente può filtrare i contenuti, mostrando solo quelli che contengono una certa stringa.
  - Caricamento dinamico dei contenuti e impostazione componente dettagli
  - Selezione e rimozione dei preferiti
  - Implementazione della barra di ricerca mediante l'evento keyup


Con il Mini-Homework 3 si implementa:

  - Una sezione “Situazione COVID-19”, all’interno della quale sono mostrati i dati relativi ai Casi confermati, i pazienti Guariti e i Decessi per l’Italia e la Sicilia. Realizzata attraverso l’API M-Media-Group Covid-19-API (without Auth).
  - Una sezione “Meteo” all’interno della quale viene mostrato il meteo relativo alla geolocalizzazione del client (implementata attraverso l’API Abstract IP Geolocation - apiKey Auth). Le informazioni meteo vengono ottenute attraverso l’API Weatherstack (apiKey Auth).


Con l'Homework 1 si implementa:

  - Meccanismo di registrazione, login, logout degli utenti, con opportuna validazione dei dati (sia lato client che lato server). Dal lato client sono state implementate verifiche su: username già in uso, password con una struttura ben definita e verifica coincidenza password. 
  - I “blocchi di contenuto” visulizzati nella Home sono caricati accedendo tramite API REST a pagine PHP.
  - La pagina Parafarmacie supporta meccanismi di interazione con l’utente tramite JavaScript, e richieste asincrone.
  - Il sito deve prevede la possibilità di ricercare contenuti tramite API REST (IP geolocation API e Weatherstack API) e di inserire nel database alcuni dei contenuti scelti dall’utente attraverso le pagine "Aggiungi..."
