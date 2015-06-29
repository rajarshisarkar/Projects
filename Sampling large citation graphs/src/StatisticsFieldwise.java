/*
 * To run this code: java StatisticsFieldwise
*/

import java.awt.BasicStroke;
import java.awt.BorderLayout;
import java.awt.Color;
import javax.swing.JPanel;
import javax.swing.JLabel;
import java.awt.Stroke;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.Iterator;
import java.util.LinkedHashSet;
import org.jfree.chart.ChartFactory;
import org.jfree.chart.ChartPanel;
import org.jfree.chart.JFreeChart;
import org.jfree.chart.axis.NumberAxis;
import org.jfree.chart.axis.CategoryAxis;
import org.jfree.chart.plot.CategoryPlot;
import org.jfree.chart.plot.PlotOrientation;
import org.jfree.chart.renderer.category.LineAndShapeRenderer;
import org.jfree.data.category.CategoryDataset;
import org.jfree.data.category.DefaultCategoryDataset;
import org.jfree.ui.ApplicationFrame;
import org.jfree.ui.RefineryUtilities;
import org.jfree.chart.axis.CategoryLabelPositions;

public class StatisticsFieldwise extends ApplicationFrame {

    int count = 0, ufield;

    public StatisticsFieldwise(final String title) throws IOException {
	super(title);
	final CategoryDataset dataset = createDataset();
	final JFreeChart chart = createChart(dataset);
	final ChartPanel chartPanel = new ChartPanel(chart);
	chartPanel.setPreferredSize(new java.awt.Dimension(1024, 768));
	this.add(chartPanel, BorderLayout.CENTER);
	JPanel customPanel = new JPanel();
	JLabel lbl = new JLabel("<html><h4>Total papers published in year [1960, 2009]: 711810<br>Total non unique fields: " + count + "<br>Total unique fields: " + ufield
		+ "</h4></html>");
	customPanel.add(lbl);
	this.add(customPanel, BorderLayout.SOUTH);
    }

    private CategoryDataset createDataset() throws IOException {
	DefaultCategoryDataset dataset = null;
	BufferedReader br = null;
	String sCurrentLine;
	String fieldstr;
	LinkedHashSet hs = new LinkedHashSet();

	try {
	    br = new BufferedReader(new FileReader("/home/rajarshi/Downloads/IIT_Kharagpur/CNeRG/data/taggeddataset"));

	    while ((sCurrentLine = br.readLine()) != null) {
		String toprocess = sCurrentLine;
		if (toprocess.matches("#f(.*)")) {
		    fieldstr = toprocess.substring(2, toprocess.length());
		    hs.add(fieldstr);
		    count++;
		}
	    }

	    Iterator itr1 = hs.iterator();
	    int i = 0;
	    while (itr1.hasNext()) {
		itr1.next();
		i++;
	    }
	} catch (IOException e) {
	    e.printStackTrace();
	} finally {
	    try {
		if (br != null)
		    br.close();
	    } catch (IOException ex) {
		ex.printStackTrace();
	    }
	}

	int[] field = new int[hs.size()];
	br = new BufferedReader(new FileReader("/home/rajarshi/Downloads/IIT_Kharagpur/CNeRG/data/taggeddataset"));
	while ((sCurrentLine = br.readLine()) != null) {
	    String toprocess = sCurrentLine;
	    if (toprocess.matches("#f(.*)")) {
		fieldstr = toprocess.substring(2, toprocess.length());
		int j = 0;
		Iterator itr2 = hs.iterator();
		while (itr2.hasNext()) {
		    if (itr2.next().toString().equals(fieldstr))
			field[j] += 1;
		    j++;
		}
	    }
	}

	Iterator itr3 = hs.iterator();
	int i = 0;
	dataset = new DefaultCategoryDataset();
	while (itr3.hasNext()) {
	    dataset.addValue(field[i++], "Number of papers published in a particular field", itr3.next().toString());
	}

	Iterator itr4 = hs.iterator();
	i = 0;
	while (itr4.hasNext()) {
	    System.out.println("Papers published in " + itr4.next() + " field: " + field[i++]);
	}

	System.out.println("Total non unique fields: " + count);
	System.out.println("All unique fields: " + hs);
	System.out.println("Total unique fields: " + hs.size());
	ufield = hs.size();
	return dataset;
    }

    private JFreeChart createChart(final CategoryDataset dataset) {
	final JFreeChart chart = ChartFactory.createLineChart("No. of papers published vs Field plot", // chart
		"Field", // domain(x-axis) axis label
		"No. of papers published", // range(y-axis) axis label
		dataset, // data
		PlotOrientation.VERTICAL, // orientation
		true, // include legend
		true, // tooltips
		false // urls
		);

	chart.setBackgroundPaint(Color.white);
	final CategoryPlot plot = (CategoryPlot) chart.getPlot();
	plot.setBackgroundPaint(new Color(0xffffe0));
	plot.setDomainGridlinesVisible(true);
	plot.setDomainGridlinePaint(Color.lightGray);
	plot.setRangeGridlinePaint(Color.lightGray);
	final CategoryAxis domainAxis = (CategoryAxis) plot.getDomainAxis();
	domainAxis.setCategoryLabelPositions(CategoryLabelPositions.UP_45);
	final NumberAxis rangeAxis = (NumberAxis) plot.getRangeAxis();
	rangeAxis.setStandardTickUnits(NumberAxis.createIntegerTickUnits());
	rangeAxis.setAutoRangeIncludesZero(true);
	final LineAndShapeRenderer renderer = (LineAndShapeRenderer) plot.getRenderer();
	renderer.setBaseShapesFilled(true);
	renderer.setBaseShapesVisible(true);
	Stroke stroke = new BasicStroke(3f, BasicStroke.CAP_ROUND, BasicStroke.JOIN_BEVEL);
	renderer.setBaseOutlineStroke(stroke);

	return chart;
    }

    public static void main(final String[] args) throws IOException {
	final StatisticsFieldwise demo = new StatisticsFieldwise("");
	demo.pack();
	RefineryUtilities.centerFrameOnScreen(demo);
	demo.setVisible(true);
    }
}
