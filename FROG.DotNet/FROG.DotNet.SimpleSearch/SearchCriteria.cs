using System;
using System.Collections.Generic;
using System.Text;

namespace FROG.DotNet.SimpleSearch
{
    // Just data.
    public class SearchCriteria
    {
        public string Property { get; set; }
        public SearchComparison CompareType { get; set; }
        public string Value { get; set; }
        public int Multiplier { get; set; }
        public int Weight { get; set; } 
    }
}
