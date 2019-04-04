using System;
using System.Collections.Generic;
using System.Text;

namespace frontendApp.models
{
    class BezoekerModel
    {
        public BezoekerModel(string bezoekerUUID, string badgeUUID, string achteraam, string voornaam, string email, string adres, string btwnummer, string bankrekeningnummer, bool isAanwezig, bool isGeblokkeerd, bool isActief, int versienummer)
        {
            this.bezoekerUUID = bezoekerUUID;
            this.badgeUUID = badgeUUID;
            this.achternaam = achteraam;
            this.voornaam = voornaam;
            this.email = email;
            this.adres = adres;
            this.btwnummer = btwnummer;
            this.bankrekeningnummer = bankrekeningnummer;
            this.isAanwezig = isAanwezig;
            this.isGeblokkeerd = isGeblokkeerd;
            this.isActief = isActief;
            this.versienummer = versienummer;
        }

        public BezoekerModel(string bezoekerUUID, string achteraam, string voornaam, bool isActief, int versienummer)
        {
            this.bezoekerUUID = bezoekerUUID;
            this.achternaam = achteraam;
            this.voornaam = voornaam;
            this.isActief = isActief;
            this.versienummer = versienummer;
        }

        public string bezoekerUUID { get; set; }
        public string badgeUUID { get; set; }
        public string achternaam { get; set; }
        public string voornaam { get; set; }
        public string email { get; set; }
        public string adres { get; set; }
        public string btwnummer { get; set; }
        public string bankrekeningnummer { get; set; }
        public bool isAanwezig { get; set; }
        public bool isGeblokkeerd { get; set; }
        public bool isActief { get; set; }
        public int versienummer { get; set; }
    }
}
