using System;
using System.Collections.Generic;
using System.Text;

namespace frontend.models
{
    class SessieModel
    {
        public SessieModel(string sessieUUID, string naam, string omschrijving, string organisatieUUID, string gastspreker, string startDatum, string eindDatum, string plaats, double kostprijsSessie, int beschikbarePlaatsen, string benodigdheden, bool isReserverend, bool isActief, int versienummer)
        {
            this.sessieUUID = sessieUUID;
            this.naam = naam;
            this.omschrijving = omschrijving;
            this.organisatieUUID = organisatieUUID;
            this.gastspreker = gastspreker;
            this.startDatum = startDatum;
            this.eindDatum = eindDatum;
            this.plaats = plaats;
            this.kostprijsSessie = kostprijsSessie;
            this.beschikbarePlaatsen = beschikbarePlaatsen;
            this.benodigdheden = benodigdheden;
            this.isReserverend = isReserverend;
            this.isActief = isActief;
            this.versienummer = versienummer;
        }

        public SessieModel(string sessieUUID, string naam, bool isActief, int versienummer)
        {
            this.sessieUUID = sessieUUID;
            this.naam = naam;
            this.isActief = isActief;
            this.versienummer = versienummer;
        }

        public string sessieUUID { get; set; }
        public string naam { get; set; }
        public string omschrijving { get; set; }
        public string organisatieUUID { get; set; }
        public string gastspreker { get; set; }
        public string startDatum { get; set; }
        public string eindDatum { get; set; }
        public string plaats { get; set; }
        public double kostprijsSessie { get; set; }
        public int beschikbarePlaatsen { get; set; }
        public string benodigdheden { get; set; }
        public bool isReserverend { get; set; }
        public bool isActief { get; set; }
        public int versienummer { get; set; }
    }
}
